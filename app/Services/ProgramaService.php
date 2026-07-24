<?php

namespace App\Services;

use App\Models\Programa;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ProgramaService
{
    public function store(
        array $data
    ): Programa {

        $this->validarHoras($data);

        return DB::transaction(
            fn () => Programa::create($data)
        );
    }

    public function update(
        Programa $programa,
        array $data
    ): bool {

        $this->validarHoras($data);

        return DB::transaction(
            fn () => $programa->update($data)
        );
    }

    public function delete(
        Programa $programa
    ): void {

        if (
            $programa->competencias()->exists()
            || $programa->aprendizs()->exists()
            || $programa->ficha_caracterizacions()->exists()
        ) {
            throw new RuntimeException(
                'No se puede eliminar el programa porque tiene registros asociados.'
            );
        }

        DB::transaction(
            fn () => $programa->delete()
        );
    }

    private function validarHoras(
        array $data
    ): void {

        $horasCalculadas =
            (int) $data['prog_etapaLectiva']
            +
            (int) $data['prog_etapaProductiva'];

        if (
            $horasCalculadas !==
            (int) $data['prog_totalHoras']
        ) {
            throw new RuntimeException(
                'La suma de las etapas debe coincidir con las horas totales.'
            );
        }
    }
}
