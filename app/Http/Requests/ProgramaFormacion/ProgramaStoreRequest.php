<?php

namespace App\Http\Requests\ProgramaFormacion\ProgramaStoreRequest;

use Illuminate\Foundation\Http\FormRequest;

class ProgramaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'prog_Denominacion' => [
                'required',
                'string',
                'max:255'
            ],

            'prog_version' => [
                'required',
                'integer'
            ],

            'prog_Estado' => [
                'nullable',
                'string'
            ],

            'prog_HorasEstimadas' => [
                'required',
                'string'
            ],

            'prog_Creditos' => [
                'required',
                'string'
            ],

            'prog_Descripcion' => [
                'required',
                'string'
            ],

            'prog_DuracionMeses' => [
                'required',
                'string'
            ],

            'prog_NivelFormacion' => [
                'nullable',
                'string'
            ],

            'prog_etapaLectiva' => [
                'required',
                'integer',
                'min:1'
            ],

            'prog_etapaProductiva' => [
                'required',
                'integer',
                'min:1'
            ],

            'prog_totalHoras' => [
                'required',
                'integer',
                'min:1'
            ],

            'prog_justificacion' => [
                'required',
                'string'
            ],

            'prog_metodologia' => [
                'required',
                'string'
            ],
        ];
    }
}
