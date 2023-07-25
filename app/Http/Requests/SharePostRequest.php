<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SharePostRequest extends FormRequest
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
                'required',
                Rule::exists('posts', 'id')->whereNull('deleted_at'),
            ],
            'content' => 'max:140',
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
            'post_id' => 'The original post is no longer available. You cannot share this content.',
            'content.max' => 'Your post must be at least 140 characters long.',
        ];
    }
}
