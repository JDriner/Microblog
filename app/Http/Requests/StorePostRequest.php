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
            'content' => 'required|max:140',
            'image' => 'bail|image|mimes:jpeg,jpg,png,svg|size:2048',
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
            'image.image' => 'Please upload a valid image file.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and SVG image formats are allowed.',
            'image.size' => 'The image size must not exceed 4MB.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(
    //         response()->json(['code' => 0, 'error' => $validator->errors()->toArray()], 422)
    //     );
    // }
}
