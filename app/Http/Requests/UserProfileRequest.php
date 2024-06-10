<?php

namespace App\Http\Requests;

use App\Enums\CreateStatusEnum;
use App\Enums\StatusEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserProfileRequest extends FormRequest
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
        //dd(request()->all());
        return [
            "name"      =>  "required|string|max:255",
            "surname"   =>  "required|string|max:255",
            "phone"     =>  "required|numeric",
            "address"   =>  "required|string|max:255",
            /*"role"      =>  ['required', Rule::enum(UserRoleEnum::class)],
            "status"    =>  ['required', Rule::enum(StatusEnum::class)],*/
            "role_id"   =>  "required|numeric",
            "status"    =>  [
                Rule::requiredIf(request()->isMethod("put")),
                Rule::enum(StatusEnum::class),
            ],
            "image"     =>  ["nullable", "image", "mimes:jpg,jpeg,png,gif,svg"],
            //'image'     =>  ['nullable', 'image'],
            //"image"   =>  [Rule::requiredIf(request()->isMethod("post")), "image", "mimes:jpg,jpeg,png,gif,svg"],
        ];
    }
}
