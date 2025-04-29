<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsurancePolicyUpdateRequest extends FormRequest
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
            'img' => 'nullable|image|max:5120',
            "card_type_id" => "required|string",
            "description" => "nullable|string",
            "summary" => "nullable|string",
            "geographic_area_id" => "required|string",
            "title" => "required|string",
            "price" => "required|integer",
            "countries" => "required|array",
            "validity_period_type" => "required|string",
            "validity_period_value" => "required|integer",
        ];
    }
}
