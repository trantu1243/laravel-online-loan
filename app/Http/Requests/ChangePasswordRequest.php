<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password' => ['required', 'confirmed', 'min:8', 'max:32', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Bạn chưa nhập password',
            'password.confirmed' => 'Xác nhận password không khớp',
            'password.min' => 'Password phải có ít nhất 8 ký tự',
            'password.max' => 'Password không được vượt quá 32 ký tự',
            'password.string' => 'Password phải là chuỗi ký tự',
        ];
    }
}
