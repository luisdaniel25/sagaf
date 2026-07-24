<?php

namespace App\Services;

use App\Models\FichaCaracterizacion;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class FichaCaracterizacionService
{
    public function store(
        array $data
    ): FichaCaracterizacion {

        return DB::transaction(
            fn() => FichaCaracterizacion::create($data)
        );
    }

    public function update(
        FichaCaracterizacion $ficha,
        array $data
    ): bool {

        return DB::transaction(
            fn() => $ficha->update($data)
        );
    }

    public function delete(
        FichaCaracterizacion $ficha
    ): void {

        if (
            $ficha->aprendizs()->exists()
        ) {
            throw new RuntimeException(
                'La ficha tiene aprendices asociados.'
            );
        }

        DB::transaction(
            fn() => $ficha->delete()
        );
    }
}
