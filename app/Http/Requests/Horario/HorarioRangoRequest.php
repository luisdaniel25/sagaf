<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorarioRangoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'desde' => [
                'required',
                'date'
            ],

            'hasta' => [
                'required',
                'date',
                'after_or_equal:desde'
            ],
        ];
    }
}
