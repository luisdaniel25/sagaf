<?php

namespace App\Http\Requests;

class FichaUpdateRequest extends FichaStoreRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        unset($rules['Codigo']);

        return $rules;
    }
}
