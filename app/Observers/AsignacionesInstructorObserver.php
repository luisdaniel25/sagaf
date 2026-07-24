<?php

namespace App\Observers;

use App\Models\Ambiente;
use App\Models\AsignacionesInstructore;
use App\Models\EstadoAmbiente;

class AsignacionesInstructorObserver
{
    public function created(
        AsignacionesInstructore $asignacion
    ): void {

        if ($asignacion->Codigo_ambiente) {

            $this->actualizarEstadoAmbiente(
                $asignacion->Codigo_ambiente,
                EstadoAmbiente::OCUPADO
            );
        }
    }

    public function updated(
        AsignacionesInstructore $asignacion
    ): void {

        if (
            $asignacion->wasChanged(
                'Codigo_ambiente'
            )
        ) {

            $ambienteAnteriorId =
                $asignacion->getOriginal(
                    'Codigo_ambiente'
                );

            $nuevoAmbienteId =
                $asignacion->Codigo_ambiente;

            if ($ambienteAnteriorId) {

                $this->actualizarEstadoAmbiente(
                    $ambienteAnteriorId,
                    EstadoAmbiente::DISPONIBLE
                );
            }

            if ($nuevoAmbienteId) {

                $this->actualizarEstadoAmbiente(
                    $nuevoAmbienteId,
                    EstadoAmbiente::OCUPADO
                );
            }
        }

        if (
            $asignacion->wasChanged(
                'Estado'
            )
            &&
            in_array(
                $asignacion->Estado,
                [
                    AsignacionesInstructore::FINALIZADO,
                    AsignacionesInstructore::CANCELADO,
                ],
                true
            )
        ) {

            if ($asignacion->Codigo_ambiente) {

                $this->actualizarEstadoAmbiente(
                    $asignacion->Codigo_ambiente,
                    EstadoAmbiente::DISPONIBLE
                );
            }
        }
    }

    public function deleted(
        AsignacionesInstructore $asignacion
    ): void {

        if ($asignacion->Codigo_ambiente) {

            $this->actualizarEstadoAmbiente(
                $asignacion->Codigo_ambiente,
                EstadoAmbiente::DISPONIBLE
            );
        }
    }

    private function actualizarEstadoAmbiente(
        int $ambienteId,
        int $nuevoEstado
    ): void {

        $ambiente = Ambiente::find(
            $ambienteId
        );

        if (!$ambiente) {
            return;
        }

        if (
            $ambiente->Codigo_estado ===
            EstadoAmbiente::MANTENIMIENTO
        ) {
            return;
        }

        $ambiente->forceFill([
            'Codigo_estado' => $nuevoEstado
        ])->saveQuietly();
    }
}
