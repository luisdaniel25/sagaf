<?php

namespace App\Http\Controllers;

use App\Services\NotificacionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function __construct(
        private readonly NotificacionService $notificacionService
    ) {
    }

    /**
     * Mostrar todas las notificaciones del usuario.
     */
    public function index(): View
    {
        $usuarioId = Auth::id();

        $notificaciones = $this->notificacionService
            ->obtenerNotificacionesUsuario(
                $usuarioId,
                15
            );

        $totalNoLeidas = $this->notificacionService
            ->contarNotificacionesNoLeidas(
                $usuarioId
            );

        return view(
            'notificaciones.index',
            compact(
                'notificaciones',
                'totalNoLeidas'
            )
        );
    }

    /**
     * Mostrar notificaciones no leídas para dropdown.
     */
    public function noLeidas(): View
    {
        $usuarioId = Auth::id();

        $notificaciones = $this->notificacionService
            ->obtenerNotificacionesNoLeidas(
                $usuarioId
            );

        $totalNoLeidas = $notificaciones->count();

        return view(
            'layouts.partials.notificaciones-dropdown',
            compact(
                'notificaciones',
                'totalNoLeidas'
            )
        );
    }

    /**
     * Marcar una notificación como leída.
     */
    public function marcarLeida(
        int $id
    ): RedirectResponse {

        $result = $this->notificacionService
            ->marcarComoLeida(
                $id,
                Auth::id()
            );

        return redirect()
            ->back()
            ->with(
                $result ? 'success' : 'error',
                $result
                    ? 'Notificación marcada como leída'
                    : 'No se pudo marcar la notificación como leída'
            );
    }

    /**
     * Marcar todas las notificaciones como leídas.
     */
    public function marcarTodasLeidas(): RedirectResponse
    {
        $result = $this->notificacionService
            ->marcarTodasComoLeidas(
                Auth::id()
            );

        return redirect()
            ->back()
            ->with(
                $result ? 'success' : 'error',
                $result
                    ? 'Todas las notificaciones marcadas como leídas'
                    : 'No se pudieron marcar las notificaciones como leídas'
            );
    }

    /**
     * Archivar una notificación.
     */
    public function archivar(
        int $id
    ): RedirectResponse {

        $result = $this->notificacionService
            ->archivarNotificacion(
                $id,
                Auth::id()
            );

        return redirect()
            ->back()
            ->with(
                $result ? 'success' : 'error',
                $result
                    ? 'Notificación archivada'
                    : 'No se pudo archivar la notificación'
            );
    }

    /**
     * Obtener contador de notificaciones no leídas.
     */
    public function contarNoLeidas(): JsonResponse
    {
        $total = $this->notificacionService
            ->contarNotificacionesNoLeidas(
                Auth::id()
            );

        return response()->json([
            'total' => $total
        ]);
    }
}
