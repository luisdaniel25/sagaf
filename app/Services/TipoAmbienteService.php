<?php

namespace App\Services;

use App\Models\TipoAmbiente;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TipoAmbienteService
{
    public function store(
        array $data
    ): TipoAmbiente {

        return DB::transaction(
            fn () => TipoAmbiente::create($data)
        );
    }

    public function update(
        TipoAmbiente $tipoAmbiente,
        array $data
    ): bool {

        return DB::transaction(
            fn () => $tipoAmbiente->update($data)
        );
    }

    public function delete(
        TipoAmbiente $tipoAmbiente
    ): void {

        if (
            $tipoAmbiente
                ->ambientes()
                ->exists()
        ) {
            throw new RuntimeException(
                'No se puede eliminar el tipo de ambiente porque tiene ambientes asociados.'
            );
        }

        DB::transaction(
            fn () => $tipoAmbiente->delete()
        );
    }
}
