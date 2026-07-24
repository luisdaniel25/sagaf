<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipoAmbienteUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tipoAmbiente = $this->route('tipoAmbiente');

        return [
            'tip_Denominacion' => [
                'required',
                'string',
                'max:255',
                Rule::unique(
                    'tbl_tipo_ambientes',
                    'tip_Denominacion'
                )->ignore(
                    $tipoAmbiente->Codigo,
                    'Codigo'
                ),
            ],
        ];
    }
}
