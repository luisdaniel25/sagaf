<?php

namespace App\Http\Requests\Solicitud;

use Illuminate\Foundation\Http\FormRequest;
class SolicitudStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [

            'Codigo_competencia' => [
                'required',
                'exists:tbl_competencias,comp_codigoCompetencia'
            ],

            'Codigo_ficha' => [
                'required',
                'exists:tbl_ficha_caracterizacions,Codigo'
            ],

            'sol_FechaPropuesta' => [
                'required',
                'date',
                'after_or_equal:today'
            ],

            'sol_HorasSolicitadas' => [
                'required',
                'integer',
                'min:1'
            ],

            'sol_Justificacion' => [
                'required',
                'string'
            ]
        ];
    }
}
