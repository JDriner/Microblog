<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class EditPostRequest extends FormRequest
{
    // public function authorize()
    // {
    //     $postId = $request->post_id;

    //     $post = Post::find($postId);

    //     return Gate::allows('update', $post);
    // }

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
            'content' => 'required_without_all:image|max:140',
            'image' => [
                // 'required_without_all:content',
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
            'content.required_without_all' => 'Please enter the content of your post.',
            'content.max' => 'Your post must be at least 140 characters long.',
            // 'image.required_without_all' => 'Please upload an image of your post when you have no content.',
            'image.image' => 'Please upload a valid image file.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and SVG image formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }
}
