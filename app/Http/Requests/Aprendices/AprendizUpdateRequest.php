<?php

namespace App\Http\Requests\Aprendices;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AprendizUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $aprendiz = $this->route('aprendiz');

        return [

            'apr_PrimerNombre' => ['required','string','max:255'],
            'apr_SegundoNombre' => ['nullable','string','max:255'],
            'apr_Apellidos' => ['required','string','max:255'],
            'apr_TipoDocumento' => ['required','string','max:50'],

            'apr_NumeroDocumento' => [
                'required',
                'string',
                'max:50',
                Rule::unique(
                    'tbl_aprendizs',
                    'apr_NumeroDocumento'
                )->ignore(
                    $aprendiz->Codigo,
                    'Codigo'
                )
            ],

            'apr_FechaNacimiento' => [
                'required',
                'date',
                'before:today'
            ],

            'apr_Direccion' => [
                'nullable',
                'string',
                'max:255'
            ],

            'apr_Telefono' => [
                'nullable',
                'string',
                'max:20'
            ],

            'apr_TelefonoWhatsapp' => [
                'nullable',
                'string',
                'max:20'
            ],

            'apr_CorreoPersonal' => [
                'nullable',
                'email',
                'max:255'
            ],

            'apr_CorreoSena' => [
                'nullable',
                'email',
                'max:255'
            ],

            'apr_SedeFormacion' => [
                'required',
                'string',
                'max:255'
            ],

            'apr_Jornada' => [
                'required',
                'string',
                'max:50'
            ],

            'apr_ModalidadFormacion' => [
                'required',
                'string',
                'max:50'
            ],

            'apr_FechaInicioFormacion' => [
                'required',
                'date'
            ],

            'apr_FechaFinalizacionFormacion' => [
                'nullable',
                'date',
                'after:apr_FechaInicioFormacion'
            ],

            'Codigo_programa' => [
                'required',
                'exists:tbl_programas,prog_codigoPrograma'
            ],

            'Codigo_ficha' => [
                'required',
                'exists:tbl_ficha_caracterizacions,Codigo'
            ],

            'Codigo_centro' => [
                'required',
                'exists:tbl_centro_formacions,Codigo'
            ],

            'Codigo_regional' => [
                'nullable',
                'exists:tbl_regionales,Codigo'
            ],
        ];
    }
}
