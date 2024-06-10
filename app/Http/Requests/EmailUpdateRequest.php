<?php

namespace App\Http\Requests;

use App\Enums\CreateStatusEnum;
use App\Enums\StatusEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class EmailUpdateRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|current_password',
        ];
    }
    public function attributes(): array
    {
        return [
            'email' => 'E-mail adresi',
            'password' => 'Şifre',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => ':attribute alanı zorunludur.',
            'email.email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
            'email.unique' => 'Bu :attribute zaten kayıtlı.',
            'password.required' => ':attribute alanı zorunludur.',
            'password.current_password' => 'Mevcut :attribute yanlış.',
        ];
    }
}
