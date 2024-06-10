<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class Authencate extends FormRequest
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
            'email' => ['required','email'],
            'password' => ['required']
        ];
    }

    public function messages():array
    {
        return [
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không đúng định dạng ',
            'password.required' => 'Mật khẩu không được bỏ trống',
        ];

    }
}
