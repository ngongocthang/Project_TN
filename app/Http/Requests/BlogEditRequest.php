<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|max:100',
            'description' => 'required|max:100',
            'content' => 'required|max:500',
            'user_id' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'image.image' => 'The uploaded file must be an image!',
            'image.mimes' => 'Only image file formats (jpeg, png, jpg, gif, svg) are allowed!',
            'image.max' => 'Image must not exceed 2048 characters!',
            'title.required' => 'Title cannot be empty!',
            'title.max' => 'Title must not exceed 100 characters!',
            'description.required' => 'Description cannot be empty!',
            'description.max' => 'Description must not exceed 100 characters!',
            'content.required' => 'Content cannot be empty!',
            'content.max' => 'Content must not exceed 500 characters!',
            'user_id.required' => 'User cannot be empty!',
        ];
    }
}
