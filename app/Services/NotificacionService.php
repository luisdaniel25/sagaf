<?php

namespace App\Services;

use App\Models\Notificacione;
use Illuminate\Support\Facades\Log;

class NotificacionService
{
    /**
     * Crear notificación de asignación
     */
    public function crearNotificacionAsignacion($asignacion, $usuarioId, $titulo = null, $mensaje = null)
    {
        try {
            return Notificacione::create([
                'not_Titulo' => $titulo ?? 'Nueva Asignación de Competencia',
                'not_Mensaje' => $mensaje ?? 'Has sido asignado a una nueva competencia para la ficha.',
                'not_Tipo' => 'Asignacion',
                'not_Estado' => 'No Leida',
                'Codigo_usuario' => $usuarioId,
                'Codigo_asignacion' => $asignacion->Codigo,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creando notificación de asignación: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Crear notificación de solicitud
     */
    public function crearNotificacionSolicitud($solicitud, $usuarioId, $estado = null)
    {
        try {
            $titulo = 'Actualización de Solicitud';
            $mensaje = $estado ? "Tu solicitud ha sido {$estado}" : "Tu solicitud de programación ha sido {$solicitud->sol_Estado}";

            return Notificacione::create([
                'not_Titulo' => $titulo,
                'not_Mensaje' => $mensaje,
                'not_Tipo' => 'Solicitud',
                'not_Estado' => 'No Leida',
                'Codigo_usuario' => $usuarioId,
                'Codigo_solicitud' => $solicitud->Codigo,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creando notificación de solicitud: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Crear notificación del sistema
     */
    public function crearNotificacionSistema($usuarioId, $titulo, $mensaje, $referencia = null)
    {
        try {
            return Notificacione::create([
                'not_Titulo' => $titulo,
                'not_Mensaje' => $mensaje,
                'not_Tipo' => 'Sistema',
                'not_Estado' => 'No Leida',
                'Codigo_usuario' => $usuarioId,
                'Codigo_referencia' => $referencia?->id ?? null,
                'tipo_referencia' => $referencia ? get_class($referencia) : null,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creando notificación del sistema: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Crear notificación de recordatorio
     */
    public function crearNotificacionRecordatorio($usuarioId, $titulo, $mensaje, $evento = null)
    {
        try {
            return Notificacione::create([
                'not_Titulo' => $titulo,
                'not_Mensaje' => $mensaje,
                'not_Tipo' => 'Recordatorio',
                'not_Estado' => 'No Leida',
                'Codigo_usuario' => $usuarioId,
                'Codigo_referencia' => $evento?->id,
                'tipo_referencia' => $evento ? 'Evento' : null,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creando notificación de recordatorio: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Obtener notificaciones no leídas de un usuario
     */
    public function obtenerNotificacionesNoLeidas($usuarioId)
    {
        return Notificacione::where('Codigo_usuario', $usuarioId)
            ->where('not_Estado', 'No Leida')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Obtener todas las notificaciones de un usuario
     */
    public function obtenerNotificacionesUsuario($usuarioId, $paginate = 10)
    {
        return Notificacione::where('Codigo_usuario', $usuarioId)
            ->orderBy('created_at', 'desc')
            ->paginate($paginate);
    }

    /**
     * Marcar notificación como leída
     */
    public function marcarComoLeida($notificacionId, $usuarioId)
    {
        try {
            $notificacion = Notificacione::where('Codigo', $notificacionId)
                ->where('Codigo_usuario', $usuarioId)
                ->first();

            if ($notificacion) {
                $notificacion->update(['not_Estado' => 'Leida']);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Error marcando notificación como leída: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Marcar todas las notificaciones como leídas
     */
    public function marcarTodasComoLeidas($usuarioId)
    {
        try {
            return Notificacione::where('Codigo_usuario', $usuarioId)
                ->where('not_Estado', 'No Leida')
                ->update(['not_Estado' => 'Leida']);
        } catch (\Exception $e) {
            Log::error('Error marcando todas las notificaciones como leídas: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Archivar notificación
     */
    public function archivarNotificacion($notificacionId, $usuarioId)
    {
        try {
            $notificacion = Notificacione::where('Codigo', $notificacionId)
                ->where('Codigo_usuario', $usuarioId)
                ->first();

            if ($notificacion) {
                $notificacion->update(['not_Estado' => 'Archivada']);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Error archivando notificación: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Contar notificaciones no leídas
     */
    public function contarNotificacionesNoLeidas($usuarioId)
    {
        return Notificacione::where('Codigo_usuario', $usuarioId)
            ->where('not_Estado', 'No Leida')
            ->count();
    }
}
