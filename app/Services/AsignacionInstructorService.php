<?php

namespace App\Services;

use App\Models\AsignacionesInstructore;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class AsignacionInstructorService
{
    public function store(
        array $data
    ): AsignacionesInstructore {

        return DB::transaction(
            function () use ($data) {

                $this->validarDuplicado($data);

                return AsignacionesInstructore::create(
                    $data
                );
            }
        );
    }

    public function update(
        AsignacionesInstructore $asignacion,
        array $data
    ): bool {

        return DB::transaction(
            function () use (
                $asignacion,
                $data
            ) {

                $asignacion->update($data);

                return true;
            }
        );
    }

    public function delete(
        AsignacionesInstructore $asignacion
    ): void {

        DB::transaction(
            fn() => $asignacion->delete()
        );
    }

    public function cambiarEstado(
        AsignacionesInstructore $asignacion,
        string $estado
    ): bool {

        return $asignacion->update([
            'Estado' => $estado
        ]);
    }

    private function validarDuplicado(
        array $data
    ): void {

        $existe = AsignacionesInstructore::query()
            ->where(
                'Codigo_instructor',
                $data['Codigo_instructor']
            )
            ->where(
                'Codigo_ficha',
                $data['Codigo_ficha']
            )
            ->where(
                'Codigo_competencia',
                $data['Codigo_competencia']
            )
            ->exists();

        if ($existe) {
            throw new RuntimeException(
                'La asignación ya existe.'
            );
        }
    }
}
