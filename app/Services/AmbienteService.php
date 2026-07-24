<?php

namespace App\Services;

use App\Models\Ambiente;
use App\Models\EstadoAmbiente;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class AmbienteService
{
    public function store(array $data): Ambiente
    {
        return Ambiente::create($data);
    }

    public function update(
        Ambiente $ambiente,
        array $data
    ): bool {

        DB::transaction(function () use (
            $ambiente,
            $data
        ) {

            if (
                isset($data['Codigo_estado']) &&
                $data['Codigo_estado'] ==
                EstadoAmbiente::MANTENIMIENTO
            ) {
                $this->ponerEnMantenimiento(
                    $ambiente
                );

                return;
            }

            $ambiente->update($data);
        });

        return true;
    }

    public function delete(
        Ambiente $ambiente
    ): void {

        if (
            $ambiente
                ->asignaciones_instructores()
                ->exists()
        ) {
            throw new RuntimeException(
                'El ambiente tiene asignaciones activas.'
            );
        }

        $ambiente->delete();
    }

    public function ponerEnMantenimiento(
        Ambiente $ambiente
    ): void {

        DB::transaction(function () use (
            $ambiente
        ) {

            /**
             * Mejor desactivar que eliminar
             */

            $ambiente
                ->asignaciones_instructores()
                ->update([
                    'asig_Estado' => 'INACTIVA'
                ]);

            $ambiente->update([
                'Codigo_estado' =>
                    EstadoAmbiente::MANTENIMIENTO
            ]);
        });
    }

    public function liberar(
        Ambiente $ambiente
    ): void {

        $ambiente->update([
            'Codigo_estado' =>
                EstadoAmbiente::DISPONIBLE
        ]);
    }
}
