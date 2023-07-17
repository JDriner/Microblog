<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'post_id' => [
                Rule::exists('posts', 'id'),
            ],
            'shared_post_id' => [
                'nullable',
                Rule::exists('posts', 'id'),
            ],
            'content' => 'required|max:140',
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
            'content.required' => 'Please enter the content of your post.',
            'content.max' => 'Your post must be at least 140 characters long.',
        ];
    }
}
