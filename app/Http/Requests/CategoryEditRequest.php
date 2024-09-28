<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
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
            'name' => 'required|regex:/^[^\d]+$/|max:45',
            'description' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be empty!',
            'name.regex' => 'Name can only contain letters!',
            'name.max' => 'Name must not exceed 45 characters!',
            'description.required' => 'Description cannot be empty!',
            'description.max' => 'Description must not exceed 100 characters!',
            'image.image' => 'The uploaded file must be an image!',
            'image.mimes' => 'Only image file formats (jpeg, png, jpg, gif, svg) are allowed!',
            'image.max' => 'Image must not exceed 2048 characters!',
        ];
        
    }
}
