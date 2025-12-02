<?php

namespace App\Http\Controllers;

use App\Services\NotificacionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    protected $notificacionService;

    public function __construct(NotificacionService $notificacionService)
    {
        $this->notificacionService = $notificacionService;
    }

    /**
     * Mostrar todas las notificaciones
     */
    public function index()
    {
        $notificaciones = $this->notificacionService
            ->obtenerNotificacionesUsuario(Auth::id(), 15);

        $totalNoLeidas = $this->notificacionService
            ->contarNotificacionesNoLeidas(Auth::id());

        return view('notificaciones.index', compact('notificaciones', 'totalNoLeidas'));
    }

    /**
     * Mostrar notificaciones no leídas (para dropdown)
     */
    public function noLeidas()
    {
        $notificaciones = $this->notificacionService
            ->obtenerNotificacionesNoLeidas(Auth::id());

        $totalNoLeidas = $notificaciones->count();

        return view('layouts.partials.notificaciones-dropdown',
            compact('notificaciones', 'totalNoLeidas'));
    }

    /**
     * Marcar notificación como leída
     */
    public function marcarLeida($id)
    {
        $result = $this->notificacionService->marcarComoLeida($id, Auth::id());

        if ($result) {
            return redirect()->back()
                ->with('success', 'Notificación marcada como leída');
        }

        return redirect()->back()
            ->with('error', 'No se pudo marcar la notificación como leída');
    }

    /**
     * Marcar todas como leídas
     */
    public function marcarTodasLeidas()
    {
        $result = $this->notificacionService->marcarTodasComoLeidas(Auth::id());

        if ($result) {
            return redirect()->back()
                ->with('success', 'Todas las notificaciones marcadas como leídas');
        }

        return redirect()->back()
            ->with('error', 'No se pudieron marcar las notificaciones como leídas');
    }

    /**
     * Archivar notificación
     */
    public function archivar($id)
    {
        $result = $this->notificacionService->archivarNotificacion($id, Auth::id());

        if ($result) {
            return redirect()->back()
                ->with('success', 'Notificación archivada');
        }

        return redirect()->back()
            ->with('error', 'No se pudo archivar la notificación');
    }

    /**
     * Obtener contador de notificaciones no leídas (para AJAX)
     */
    public function contarNoLeidas()
    {
        $total = $this->notificacionService->contarNotificacionesNoLeidas(Auth::id());

        return response()->json(['total' => $total]);
    }
}
