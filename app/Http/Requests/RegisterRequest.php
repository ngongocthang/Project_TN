<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Cập nhật: kiểm tra định dạng ảnh
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'name.regex' => 'Tên không được có kí tự đặc biệt hoặc số.',
            'name.max' => 'Tên không được vượt quá 255 kí tự.',

            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 kí tự.',
            'email.unique' => 'Email đã tồn tại.',

            'password.required' => 'Mật khẩu không được để trống.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 kí tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',

            'thumbnail.image' => 'Ảnh đại diện phải là một tệp hình ảnh.',
            'thumbnail.mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'Ảnh đại diện không được vượt quá 2048 KB.',
        ];
    }
}
