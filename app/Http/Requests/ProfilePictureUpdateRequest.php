<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfilePictureUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'profile_picture' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
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
            'profile_picture.required' => 'Please upload your picture.',
            'profile_picture.mimes' => 'Only jpg, png and gif image formats are allowed.',
            'profile_picture.max' => 'Please upload files less than 2mb.',
        ];
    }
}
