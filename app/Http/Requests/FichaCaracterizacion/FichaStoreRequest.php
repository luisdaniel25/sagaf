<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FichaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'Codigo' => [
                'required',
                'integer',
                'unique:tbl_ficha_caracterizacions,Codigo'
            ],

            'fich_Inicio' => [
                'required',
                'date'
            ],

            'fich_Fin' => [
                'required',
                'date',
                'after:fich_Inicio'
            ],

            'fich_Etapa' => [
                'required',
                'in:Lectiva,Productiva'
            ],

            'Codigo_modalidad' => [
                'required',
                'exists:tbl_modalidads,id'
            ],

            'Codigo_programa' => [
                'required',
                'exists:tbl_programas,prog_codigoPrograma'
            ],

            'Codigo_centro' => [
                'required',
                'exists:tbl_centro_formacions,Codigo'
            ],
        ];
    }
}
