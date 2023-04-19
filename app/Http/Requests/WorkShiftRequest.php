<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkShiftRequest extends ApiRequest
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
            "start" => ["required", "date_format:Y-m-d H:i", "after_or_equal:now"],
            "end" => ["required", "date_format:Y-m-d H:i", "after_or_equal:start"]
        ];
    }
}
