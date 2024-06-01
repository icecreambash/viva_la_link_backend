<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PatchUserRequest extends FormRequest
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
            'email' => 'sometimes|email',
            'name' => 'sometimes|string|min:3|max:255',
            'current_password' => 'sometimes|string',
            'password' => 'sometimes|min:6|max:40|confirmed'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
