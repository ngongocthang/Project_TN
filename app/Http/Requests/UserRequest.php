<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->route('user'); // Lấy ID người dùng từ route

        return [
            'name' => 'required|regex:/^[A-Za-z\s]+$/|max:45',
            'email' => 'required|email|max:100|unique:users,email' . ($userId ? ",$userId" : ''),
            'password' => 'required|min:20|regex:/^[\S]+$/',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Name cannot be empty!',
            'name.regex' => 'Name can only contain letters!',
            'name.max' => 'Name must not exceed 45 characters!',
            'email.required' => 'Email cannot be empty!',
            'email.email' => 'Email must be in the correct format!',
            'email.unique' => 'Email has already been used!',
            'email.max' => 'Email must not exceed 100 characters!',
            'password.required' => 'Password cannot be empty!',
            'password.min' => 'Password must be at least 20 characters long!',
            'password.regex' => 'Password can only contain letters, numbers, and some special characters!',
        ];
    }
}
