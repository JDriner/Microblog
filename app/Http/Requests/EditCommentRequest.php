<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment_id' => [
                Rule::exists('comments', 'id'),
            ],
            'comment' => 'required|max:140',
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
            'comment_id' => 'The comment is not existing!',
            'comment.required' => 'Your comment should not be empty',
            'comment.max' => 'Your comment should not exceed 140 characters.',
        ];
    }
}
