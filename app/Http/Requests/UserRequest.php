<?php

namespace App\Http\Requests;

use App\Enums\CreateStatusEnum;
use App\Enums\StatusEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use newrelic\DistributedTracePayload;

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
        return [
            "name"      =>  "required|string|max:255",
            "surname"   =>  "required|string|max:255",
            "email"     =>  "required|string|max:50",
            "phone"     =>  "required|numeric",
            "address"   =>  "nullable|string|max:255",
            "role_id"   =>  "required|numeric",
            "status"    =>  [
                Rule::requiredIf(request()->isMethod("put")),
                Rule::enum(StatusEnum::class),
            ],
            //"status"    => ['required', Rule::enum(StatusEnum::class)],
            //"image"     =>  [Rule::requiredIf(request()->isMethod("post")), "image", "mimes:jpg,jpeg,png,gif,svg"],
            "image"     =>  ["nullable", "image", "mimes:jpg,jpeg,png,gif,svg"],
        ];
    }
    public function messages(): array
    {
        return [
            "name.required"       => "Ad alanı zorunludur.",
            "name.string"         => "Ad alanı metin türünde olmalıdır.",
            "name.max"            => "Ad alanı en fazla 255 karakter olmalıdır.",
            "surname.required"    => "Soyad alanı zorunludur.",
            "surname.string"      => "Soyad alanı metin türünde olmalıdır.",
            "surname.max"         => "Soyad alanı en fazla 255 karakter olmalıdır.",
            "email.required"      => "E-posta alanı zorunludur.",
            "email.string"        => "E-posta alanı metin türünde olmalıdır.",
            "email.max"           => "E-posta alanı en fazla 50 karakter olmalıdır.",
            "phone.required"      => "Telefon alanı zorunludur.",
            "phone.numeric"       => "Telefon alanı sayısal olmalıdır.",
            "address.string"      => "Adres alanı metin türünde olmalıdır.",
            "address.max"         => "Adres alanı en fazla 255 karakter olmalıdır.",
            "role_id.required"    => "Rol alanı zorunludur.",
            "role_id.numeric"     => "Rol alanı sayısal olmalıdır.",
            "image.image"         => "Yüklenen dosya bir resim olmalıdır.",
            "image.mimes"         => "Resim sadece şu uzantılarda olabilir: jpg, jpeg, png, gif, svg.",
            "status.required"     => "Durumu alanı zorunludur."
        ];
    }

    public function attributes(): array
    {
        return [
            "name"      => "Ad",
            "surname"   => "Soyad",
            "email"     => "E-posta",
            "phone"     => "Telefon",
            "address"   => "Adres",
            "role_id"   => "Rol",
            "image"     => "Resim",
            "status"    =>  "Durum"
        ];
    }

}
