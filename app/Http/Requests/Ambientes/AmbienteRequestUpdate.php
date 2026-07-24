<?php

namespace App\Http\Requests\Ambientes;

use Illuminate\Foundation\Http\FormRequest;

class AmbienteRequestUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
            ],

            'Codigo_tipo' => [
                'required',
                'integer',
                'exists:tbl_tipo_ambientes,Codigo'
            ],

            'Codigo_estado' => [
                'required',
                'integer',
                'exists:tbl_estado_ambientes,Codigo'
            ],
        ];
    }
}
