<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompetenciaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'comp_Denominacion' => [
                'required',
                'string',
                'max:1000'
            ],

            'Codigo_programa' => [
                'required',
                'integer',
                'exists:tbl_programas,prog_codigoPrograma'
            ],

        ];
    }
}
