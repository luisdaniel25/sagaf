<?php

namespace App\Http\Requests\Solicitud;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudUpdateRequest
    extends SolicitudStoreRequest
{
    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                'sol_Estado' => [
                    'required',
                    'in:Pendiente,Aprobada,Rechazada'
                ]
            ]
        );
    }
}
