<?php

namespace App\Http\Requests\AsignacionInstructor;

use App\Models\AsignacionesInstructore;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AsignacionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'Codigo_instructor' => [
                'required',
                'exists:tbl_instructors,Codigo'
            ],

            'Codigo_ficha' => [
                'required',
                'exists:tbl_ficha_caracterizacions,Codigo'
            ],

            'Codigo_competencia' => [
                'required',
                'exists:tbl_competencias,comp_codigoCompetencia'
            ],

            'Codigo_ambiente' => [
                'nullable',
                'exists:tbl_ambientes,Codigo'
            ],

            'FechaAsignacion' => [
                'required',
                'date',
                'before_or_equal:today'
            ],

            'Estado' => [
                'required',
                Rule::in([
                    AsignacionesInstructore::ASIGNADO,
                    AsignacionesInstructore::EN_CURSO,
                    AsignacionesInstructore::FINALIZADO,
                    AsignacionesInstructore::CANCELADO,
                ]),
            ],

            'Observaciones' => [
                'nullable',
                'string',
                'max:500'
            ]
        ];
    }
}
