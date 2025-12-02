<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Competencia;
use App\Models\FichaCaracterizacion;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudCompetenciaController extends Controller
{
    /* ============================================================
    |  INSTRUCTOR — CREAR SOLICITUD
    ============================================================ */
    public function create()
    {
        $competencias = Competencia::where('comp_Tipo', 'Transversal')->get();
        $fichas = FichaCaracterizacion::all();

        return view('solicitudes.create', compact('competencias', 'fichas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Codigo_competencia' => 'required|exists:tbl_competencias,comp_codigoCompetencia',
            'Codigo_ficha' => 'required|exists:tbl_ficha_caracterizacions,Codigo',
            'sol_FechaPropuesta' => 'required|date',
            'sol_HorasSolicitadas' => 'required|integer|min:1',
            'sol_Justificacion' => 'required|string'
        ]);

        $instructor = Instructor::where('Codigo_usuario', Auth::id())->first();

        if (!$instructor) {
            return back()->with('error', 'No se encontró un instructor asociado a su usuario.');
        }

        Solicitud::create([
            'sol_FechaSolicitud' => now(),
            'sol_Estado' => 'Pendiente',
            'sol_Justificacion' => $request->sol_Justificacion,
            'Codigo_instructor' => $instructor->Codigo,
            'Codigo_competencia' => $request->Codigo_competencia,
            'Codigo_ficha' => $request->Codigo_ficha,
            'sol_FechaPropuesta' => $request->sol_FechaPropuesta,
            'sol_HorasSolicitadas' => $request->sol_HorasSolicitadas,
            'sol_Prioridad' => $request->sol_Prioridad ?? 'Media'
        ]);

        return redirect()->route('solicitudes.mis-solicitudes')
            ->with('success', 'Solicitud enviada exitosamente.');
    }

    /* ============================================================
    |  EDITAR SOLICITUD (FORMULARIO)
    ============================================================ */
    public function edit(Solicitud $solicitud)
    {
        // Verificar que el usuario es el dueño de la solicitud
        $instructor = Instructor::where('Codigo_usuario', Auth::id())->first();

        if (!$instructor || $solicitud->Codigo_instructor != $instructor->Codigo) {
            return redirect()->route('solicitudes.mis-solicitudes')
                ->with('error', 'No tienes permiso para editar esta solicitud.');
        }

        $competencias = Competencia::where('comp_Tipo', 'Transversal')->get();
        $fichas = FichaCaracterizacion::all();

        return view('solicitudes.edit', compact('solicitud', 'competencias', 'fichas'));
    }

    /* ============================================================
    |  ACTUALIZAR SOLICITUD
    ============================================================ */
    public function update(Request $request, Solicitud $solicitud)
    {
        // Verificar permisos
        $instructor = Instructor::where('Codigo_usuario', Auth::id())->first();

        if (!$instructor || $solicitud->Codigo_instructor != $instructor->Codigo) {
            return redirect()->route('solicitudes.mis-solicitudes')
                ->with('error', 'No tienes permiso para editar esta solicitud.');
        }

        $request->validate([
            'Codigo_competencia' => 'required|exists:tbl_competencias,comp_codigoCompetencia',
            'Codigo_ficha' => 'required|exists:tbl_ficha_caracterizacions,Codigo',
            'sol_FechaPropuesta' => 'required|date',
            'sol_HorasSolicitadas' => 'required|integer|min:1',
            'sol_Justificacion' => 'required|string',
            'sol_Estado' => 'required|in:Pendiente,Aprobada,Rechazada'
        ]);

        $solicitud->update([
            'Codigo_competencia' => $request->Codigo_competencia,
            'Codigo_ficha' => $request->Codigo_ficha,
            'sol_FechaPropuesta' => $request->sol_FechaPropuesta,
            'sol_HorasSolicitadas' => $request->sol_HorasSolicitadas,
            'sol_Justificacion' => $request->sol_Justificacion,
            'sol_Estado' => $request->sol_Estado,
            'sol_Prioridad' => $request->sol_Prioridad ?? 'Media'
        ]);

        return redirect()->route('solicitudes.mis-solicitudes')
            ->with('success', 'Solicitud actualizada exitosamente.');
    }

    /* ============================================================
    |  INSTRUCTOR — MIS SOLICITUDES
    ============================================================ */
    public function misSolicitudes()
    {
        $instructor = Instructor::where('Codigo_usuario', Auth::id())->first();

        if (!$instructor) {
            return redirect()->route('home')
                ->with('error', 'No se encontró un instructor asociado a su usuario.');
        }

        $solicitudes = Solicitud::where('Codigo_instructor', $instructor->Codigo)
            ->with(['competencia', 'ficha', 'instructor'])
            ->orderBy('sol_FechaSolicitud', 'DESC')
            ->get();

        return view('solicitudes.mis-solicitudes', compact('solicitudes'));
    }

    /* ============================================================
    |  COORDINADOR — LISTA DE SOLICITUDES
    ============================================================ */
    public function indexCoordinador()
    {
        $solicitudes = Solicitud::with(['instructor', 'competencia', 'ficha'])
            ->orderBy('sol_FechaSolicitud', 'DESC')
            ->get();

        return view('coordinador.solicitudes', compact('solicitudes'));
    }

    /* ============================================================
    |  VER DETALLE DE UNA SOLICITUD
    ============================================================ */
    public function show(Solicitud $solicitud)
    {
        $solicitud->load(['instructor', 'competencia', 'ficha']);
        return view('solicitudes.show', compact('solicitud'));
    }

    /* ============================================================
    |  APROBAR / RECHAZAR
    ============================================================ */
    public function aprobar(Solicitud $solicitud)
    {
        $solicitud->update([
            'sol_Estado' => 'Aprobada',
            'sol_FechaAprobacion' => now()
        ]);

        return back()->with('success', 'Solicitud aprobada exitosamente.');
    }

    public function rechazar(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'sol_Observaciones' => 'required|string'
        ]);

        $solicitud->update([
            'sol_Estado' => 'Rechazada',
            'sol_Observaciones' => $request->sol_Observaciones
        ]);

        return back()->with('success', 'Solicitud rechazada exitosamente.');
    }
}
