<?php

namespace App\Http\Requests;

use App\Enums\CreateStatusEnum;
use App\Enums\StatusEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class PasswordUpdateRequest extends FormRequest
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
            'password' => 'required|current_password',
            'new_password' => 'required|different:password|confirmed|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ];
    }
    public function attributes(): array
    {
        return [
            'password' => 'Geçerli şifre',
            'new_password' => 'Yeni şifre',
            'new_password_confirmation' => 'Yeni şifre doğrulama',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => ':attribute alanı zorunludur.',
            'password.current_password' => ':attribute yanlış.',
            'new_password.required' => ':attribute alanı zorunludur.',
            'new_password.different' => ':attribute, geçerli şifreden farklı olmalıdır.',
            'new_password.confirmed' => ':attribute doğrulama ile eşleşmiyor.',
            'new_password.min' => ':attribute en az :min karakter olmalıdır.',
            'new_password_confirmation.required' => ':attribute alanı zorunludur.',
            'new_password_confirmation.same' => ':attribute, yeni şifre ile aynı olmalıdır.',
        ];
    }
}
