<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;

class SearchTicketTripRequest extends FormRequest
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
            'from_city' => 'sometimes|string|exists:cities,id',
            'to_city' => 'sometimes|string|exists:cities,id',
            'period_start' => 'sometimes|date',
            'period_end' => 'sometimes|date|after:period_start',
            'price_sale' => 'sometimes|boolean'
        ];
    }
}
