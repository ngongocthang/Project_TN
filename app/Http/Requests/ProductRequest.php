<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:45',
            'description' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be empty!',
            'name.max' => 'Name must not exceed 45 characters!',
            
            'description.required' => 'Description cannot be empty!',
            'description.max' => 'Description must not exceed 100 characters!',
<<<<<<< HEAD
            
=======
            'image.required' => 'Image cannot be empty!',
>>>>>>> f0ca565cbe12337da2bde8dd33b988f4015b147b
            'image.image' => 'The uploaded file must be an image!',
            'image.mimes' => 'Only image file formats (jpeg, png, jpg, gif, svg) are allowed!',
            'image.max' => 'Image must not exceed 2048 characters!',
            
            'price.required' => 'Price cannot be empty!',
            'price.numeric' => 'Price must be a number!',
            
            'quantity.required' => 'Quantity cannot be empty!',
            'quantity.integer' => 'Quantity must be an integer!',
            'quantity.min' => 'Quantity must be at least 1!',
<<<<<<< HEAD
            
            'status.required' => 'Status cannot be empty!',
            
=======
>>>>>>> f0ca565cbe12337da2bde8dd33b988f4015b147b
            'category_id.required' => 'Category cannot be empty!',
        ];
        
    }
}
