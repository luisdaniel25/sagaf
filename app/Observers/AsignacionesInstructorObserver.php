<?php

namespace App\Observers;

use App\Models\AsignacionesInstructore;
use App\Models\Ambiente;

class AsignacionesInstructorObserver
{
    /**
     * Cuando se crea una asignación
     */
    public function created(AsignacionesInstructore $asignacion)
    {
        if ($asignacion->Codigo_ambiente) {
            $this->actualizarEstadoAmbiente($asignacion->Codigo_ambiente, 2); // 2 = OCUPADO
        }
    }

    /**
     * Cuando se actualiza una asignación
     */
    public function updated(AsignacionesInstructore $asignacion)
    {
        // Verificar si el ambiente cambió
        if ($asignacion->isDirty('Codigo_ambiente')) {
            $ambienteAnteriorId = $asignacion->getOriginal('Codigo_ambiente');
            $nuevoAmbienteId = $asignacion->Codigo_ambiente;

            // Liberar ambiente anterior si existe
            if ($ambienteAnteriorId) {
                $this->actualizarEstadoAmbiente($ambienteAnteriorId, 1); // 1 = LIBRE/DISPONIBLE
            }

            // Ocupar nuevo ambiente si existe
            if ($nuevoAmbienteId) {
                $this->actualizarEstadoAmbiente($nuevoAmbienteId, 2); // 2 = OCUPADO
            }
        }

        // Si el estado cambió a Finalizado o Cancelado, liberar ambiente
        if ($asignacion->isDirty('Estado') && in_array($asignacion->Estado, ['Finalizado', 'Cancelado'])) {
            if ($asignacion->Codigo_ambiente) {
                $this->actualizarEstadoAmbiente($asignacion->Codigo_ambiente, 1); // 1 = LIBRE/DISPONIBLE
            }
        }
    }

    /**
     * Cuando se elimina una asignación
     */
    public function deleted(AsignacionesInstructore $asignacion)
    {
        if ($asignacion->Codigo_ambiente) {
            $this->actualizarEstadoAmbiente($asignacion->Codigo_ambiente, 1); // 1 = LIBRE/DISPONIBLE
        }
    }

    /**
     * Método helper para actualizar estado del ambiente
     */
    private function actualizarEstadoAmbiente($ambienteId, $nuevoEstado)
    {
        if (!$ambienteId) return;

        $ambiente = Ambiente::find($ambienteId);

        if ($ambiente) {
            // Solo actualizar si no está en mantenimiento (3 = MANTENIMIENTO)
            if ($ambiente->Codigo_estado != 3) {
                $ambiente->update(['Codigo_estado' => $nuevoEstado]);
            }
        }
    }
}
