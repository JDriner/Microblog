<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
            // 'post_id' => 'exists:posts',
            'content' => 'required|max:140',
            // 4 MB in kilobytes (1 MB = 1024 KB)
            // 'image' => 'mimes:jpeg,jpg,bmp,png|file|max:4096', 
            'image' => 'image|file|max:4096'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['code' => 0, 'error' => $validator->errors()->toArray()], 422)
        );
    }
}