<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'descripcion' => [
                'required',
                'string'
            ],

            'color' => [
                'nullable',
                'string',
                'max:20'
            ],

            'start' => [
                'required',
                'date'
            ],

            'end' => [
                'required',
                'date',
                'after_or_equal:start'
            ],

            'horaInicio' => [
                'required',
                'string'
            ],

            'horaFinal' => [
                'required',
                'string'
            ],

            'Codigo_resultado_aprendizaje' => [
                'nullable',
                'exists:tbl_resultado_aprendizajes,Codigo'
            ],

            'Codigo_instructor' => [
                'nullable',
                'exists:tbl_instructors,Codigo'
            ],

            'Codigo_ficha' => [
                'nullable',
                'exists:tbl_ficha_caracterizacions,Codigo'
            ],

            'Codigo_ambiente' => [
                'nullable',
                'exists:tbl_ambientes,Codigo'
            ],

            'Codigo_competencia' => [
                'nullable',
                'exists:tbl_competencias,comp_codigoCompetencia'
            ],
        ];
    }
}
