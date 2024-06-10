<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GatewayRequest extends FormRequest
{
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
            "mac"       =>  "required|string|max:255",
            "status"    =>  [
                Rule::requiredIf(request()->isMethod("put")),
                Rule::enum(StatusEnum::class),
            ],
            "brand"             =>  "required|string|max:255",
            "sensitivity_rate"  =>  "required|string|max:100",
        ];
    }
    public function attributes(): array
    {
        return [
            'name'              => 'İsim',
            'mac'               => 'MAC adresi',
            'status'            => 'Durum',
            'brand'             => 'Marka',
            'sensitivity_rate'  => 'Yüzdelik oranı',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'             => 'Zorunlu Alan.',
            'name.string'               => 'İsim alanı bir metin olmalıdır.',
            'name.max'                  => 'İsim en fazla 255 karakter olabilir.',
            'mac.required'              => 'Zorunlu Alan',
            'mac.string'                => 'MAC adresi bir metin olmalıdır.',
            'mac.max'                   => 'MAC adresi en fazla 255 karakter olabilir.',
            'status.required_if'        => 'Zorunlu Alan',
            'status.enum'               => 'Geçersiz durum değeri.',
            'brand.required'            => 'Zorunlu Alan',
            'brand.string'              => 'Marka alanı bir metin olmalıdır.',
            'brand.max'                 => 'Marka en fazla 255 karakter olabilir.',
            'sensitivity_rate.required' => 'Zorunlu Alan',
            'sensitivity_rate.string'   => 'Yüzdelik oranı bir metin olmalıdır.',
            'sensitivity_rate.max'      => 'Yüzdelik oranı en fazla 100 karakter olabilir.',
        ];
    }
}
