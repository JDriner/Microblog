<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Rules\UniqueUnverifiedEmail;

class RegisterUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'max:50',
            ],
            'last_name' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'max:50',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                // 'unique:'.User::class,
                new UniqueUnverifiedEmail,
            ],
            'password' => [
                'required',
                'min:8',
                'max:24',
                'confirmed',
                Password::defaults(),
            ],
            'password_confirmation' => [
                'same:password',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Please enter your first name.',
            'first_name.string' => 'The first name should be a string.',
            'first_name.max' => 'The first name should not exceed 50 characters.',
            'last_name.required' => 'Please enter your last name.',
            'last_name.string' => 'The last name should be a string.',
            'last_name.max' => 'The last name should not exceed 50 characters.',
            'email.required' => 'Please enter your email address.',
            'email.string' => 'The email should be a string.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email should not exceed 255 characters.',
            'email.unique' => 'The email address is already taken.',
            'password.required' => 'Please enter a password.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password_confirmation.same' => 'The password confirmation does not match.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
