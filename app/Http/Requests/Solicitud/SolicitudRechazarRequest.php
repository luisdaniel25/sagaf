<?php

namespace App\Http\Requests\Solicitud;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudRechazarRequest
    extends FormRequest
{
    public function rules(): array
    {
        return [
            'sol_Observaciones' => [
                'required',
                'string'
            ]
        ];
    }
}
