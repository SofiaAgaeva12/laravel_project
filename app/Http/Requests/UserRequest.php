<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends ApiRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'login' => ["required", "unique:users"],
            'password' => ["required"],
            'name' => ["required"],
            'surname' => ["string"],
            'patronymic' => ["string"],
            'photo_file' => ["img:jpg,png"],
            'role_id' => ["required", "exists:roles,id"],
        ];
    }
}
