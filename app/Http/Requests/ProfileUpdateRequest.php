<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'max:255',
            ],
            'phone_no' => [
                'nullable',
                'string',
                'regex:/^(09)[0-9]{9}$/',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
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
        ];
    }
}
