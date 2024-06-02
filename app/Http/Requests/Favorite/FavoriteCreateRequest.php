<?php

namespace App\Http\Requests\Favorite;

use App\Rules\ModelFavoriteRule;
use Illuminate\Foundation\Http\FormRequest;

class FavoriteCreateRequest extends FormRequest
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
            'model_type' => [
                'required',
                'string',
                new ModelFavoriteRule(),
            ],
            'model_ids' => [
                'required',
                'array',
            ],
            'model_ids.*' => [
                'required',
                'string'
            ]
        ];
    }
}
