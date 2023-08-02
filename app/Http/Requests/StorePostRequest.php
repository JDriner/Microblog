<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required_without_all:image|max:140',
            'image' => 'required_without_all:content|mimes:jpeg,jpg,png,gif|max:2000',
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
            'content.required_without_all' => 'Please enter the content of your post when an image is not present.',
            'content.max' => 'Your post must be at least 140 characters long.',
            'image.required_without_all' => 'Please upload an image of your post when you have no content.',
            'image.mimes' => 'Only JPG, PNG and GIF image formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }
}
