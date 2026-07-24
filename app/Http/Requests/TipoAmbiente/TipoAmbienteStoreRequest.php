<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoAmbienteStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tip_Denominacion' => [
                'required',
                'string',
                'max:255',
                'unique:tbl_tipo_ambientes,tip_Denominacion'
            ],
        ];
    }
}
