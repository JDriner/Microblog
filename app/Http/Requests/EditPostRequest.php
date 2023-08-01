<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class EditPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'content' => [
                'required_without_all:image_value,image',
                'max:140',
            ],
            'image' => [
                'image',
                'mimes:jpeg,jpg,png,svg,gif',
                'max:2048',
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
            'content.required_without_all' => 'Please enter the content of your post if you have no image.',
            'content.max' => 'Your post must be at least 140 characters long.',
            'image.required_without_all' => 'Please upload an image of your post when you have no content.',
            'image.image' => 'Please upload a valid image file.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and SVG image formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }
}