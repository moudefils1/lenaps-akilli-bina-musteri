<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolePermissionRequest extends FormRequest
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
            "name"  =>  "required|string|max:255|unique:roles,name",
            "permissions"    => "nullable|array",
        ];
    }
    public function attributes(): array
    {
        return [
            "name" => "Rol Adı",
            "permissions" => "İzinler",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Zorunlu alan.",
            "name.string" => "İsim alanı metin formatında olmalıdır.",
            "name.max" => "En fazla 255 karakter girebilirsiniz.",
        ];
    }
}
