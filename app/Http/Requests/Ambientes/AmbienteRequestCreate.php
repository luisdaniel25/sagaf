<?php

namespace App\Http\Requests\Ambientes;

use Illuminate\Foundation\Http\FormRequest;

class AmbienteRequestCreate extends FormRequest
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
            'amb_Denominacion' => [
                'required',
                'string',
                'max:255'
            ],

            'amb_Cupo' => [
                'required',
                'integer',
                'min:1'
            ]
        ];

    }
}
