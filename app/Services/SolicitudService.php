<?php

namespace App\Services;

use App\Models\Instructor;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SolicitudService
{
    private function instructorAutenticado(): Instructor
    {
        $instructor = Instructor::where(
            'Codigo_usuario',
            Auth::id()
        )->first();

        if (!$instructor) {
            throw new RuntimeException(
                'No existe instructor asociado.'
            );
        }

        return $instructor;
    }

    public function crearSolicitud(
        array $data
    ): Solicitud {

        $instructor =
            $this->instructorAutenticado();

        return DB::transaction(
            function () use (
                $data,
                $instructor
            ) {

                return Solicitud::create([
                    ...$data,

                    'Codigo_instructor' =>
                        $instructor->Codigo,

                    'sol_FechaSolicitud' =>
                        now(),

                    'sol_Estado' =>
                        'Pendiente',

                    'sol_Prioridad' =>
                        $data['sol_Prioridad']
                        ?? 'Media',
                ]);
            }
        );
    }

    public function actualizarSolicitud(
        Solicitud $solicitud,
        array $data
    ): bool {

        $this->verificarPropietario(
            $solicitud
        );

        return $solicitud->update(
            $data
        );
    }

    public function verificarPropietario(
        Solicitud $solicitud
    ): void {

        $instructor =
            $this->instructorAutenticado();

        if (
            $solicitud->Codigo_instructor
            !==
            $instructor->Codigo
        ) {
            throw new RuntimeException(
                'No autorizado.'
            );
        }
    }

    public function obtenerMisSolicitudes()
    {
        $instructor =
            $this->instructorAutenticado();

        return Solicitud::with([
            'competencia',
            'ficha',
            'instructor'
        ])
            ->where(
                'Codigo_instructor',
                $instructor->Codigo
            )
            ->latest('sol_FechaSolicitud')
            ->paginate(15);
    }

    public function aprobar(
        Solicitud $solicitud
    ): bool {

        return $solicitud->update([
            'sol_Estado' => 'Aprobada',
            'sol_FechaAprobacion' => now(),
        ]);
    }

    public function rechazar(
        Solicitud $solicitud,
        string $observaciones
    ): bool {

        return $solicitud->update([
            'sol_Estado' => 'Rechazada',
            'sol_Observaciones' =>
                $observaciones,
        ]);
    }
}
