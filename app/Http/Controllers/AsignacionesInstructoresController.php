<?php

namespace App\Http\Controllers;

use App\Models\AsignacionesInstructore; // ← Modelo singular
use App\Models\Instructor;
use App\Models\FichaCaracterizacion;
use App\Models\Competencia;
use App\Models\Ambiente;
use Illuminate\Http\Request;

class AsignacionesInstructoresController extends Controller
{
    /**
     * Mostrar listado de asignaciones
     */
    public function index()
    {
        $asignaciones = AsignacionesInstructore::with([
            'instructor',
            'ficha_caracterizacion',
            'competencia',
            'ambiente'
        ])->orderBy('Codigo', 'desc')->paginate(10);

        return view('asignaciones.index', compact('asignaciones'));
    }

    /**
     * Formulario para crear nueva asignación
     */
    public function create()
    {
        $instructores = Instructor::orderBy('inst_Nombres')->get();
        $fichas = FichaCaracterizacion::with('programa')->orderBy('Codigo')->get();
        $competencias = Competencia::orderBy('comp_Denominacion')->get();
        $ambientes = Ambiente::with('tipo_ambiente')
            ->where('Codigo_estado', '!=', 3) // Excluir en mantenimiento
            ->orderBy('amb_Denominacion')
            ->get();

        return view('asignaciones.create', compact(
            'instructores', 'fichas', 'competencias', 'ambientes'
        ));
    }

    /**
     * Guardar nueva asignación
     */
    public function store(Request $request)
    {
        $request->validate([
            'Codigo_instructor'   => 'required|exists:tbl_instructors,Codigo',
            'Codigo_ficha'        => 'required|exists:tbl_ficha_caracterizacions,Codigo',
            'Codigo_competencia'  => 'required|exists:tbl_competencias,comp_codigoCompetencia',
            'Codigo_ambiente'     => 'nullable|exists:tbl_ambientes,Codigo',
            'FechaAsignacion'     => 'required|date|before_or_equal:today',
            'Estado'              => 'required|in:Asignado,En curso,Finalizado,Cancelado',
            'Observaciones'       => 'nullable|string|max:500'
        ], [
            'FechaAsignacion.before_or_equal' => 'La fecha de asignación no puede ser futura.',
            'Codigo_competencia.exists' => 'La competencia seleccionada no existe.'
        ]);

        AsignacionesInstructore::create($request->all());

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación creada correctamente.');
    }

    /**
     * Mostrar detalles de una asignación
     */
    public function show($Codigo)
    {
        // CORRECCIÓN: Usar AsignacionesInstructore (singular) en lugar de AsignacionesInstructores
        $asignacion = AsignacionesInstructore::with([
            'instructor',
            'ficha_caracterizacion.programa',
            'competencia',
            'ambiente.tipo_ambiente',
            'notificaciones'
        ])->findOrFail($Codigo);

        return view('asignaciones.show', compact('asignacion'));
    }

    /**
     * Formulario para editar asignación
     */
    public function edit($Codigo)
    {
        $asignacion = AsignacionesInstructore::findOrFail($Codigo);
        $instructores = Instructor::orderBy('inst_Nombres')->get();
        $fichas = FichaCaracterizacion::with('programa')->orderBy('Fic_Numero')->get();
        $competencias = Competencia::orderBy('comp_Denominacion')->get();
        $ambientes = Ambiente::with('tipo_ambiente')->orderBy('amb_Denominacion')->get();

        return view('asignaciones.edit', compact(
            'asignacion', 'instructores', 'fichas', 'competencias', 'ambientes'
        ));
    }

    /**
     * Actualizar asignación
     */
    public function update(Request $request, $Codigo)
    {
        $asignacion = AsignacionesInstructore::findOrFail($Codigo);

        $request->validate([
            'Codigo_instructor'   => 'required|exists:tbl_instructors,Codigo',
            'Codigo_ficha'        => 'required|exists:tbl_ficha_caracterizacions,Codigo',
            'Codigo_competencia'  => 'required|exists:tbl_competencias,comp_codigoCompetencia',
            'Codigo_ambiente'     => 'nullable|exists:tbl_ambientes,Codigo',
            'FechaAsignacion'     => 'required|date',
            'Estado'              => 'required|in:Asignado,En curso,Finalizado,Cancelado',
            'Observaciones'       => 'nullable|string|max:500'
        ]);

        $asignacion->update($request->all());

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación actualizada correctamente.');
    }

    /**
     * Eliminar asignación
     */
    public function destroy($Codigo)
    {
        $asignacion = AsignacionesInstructore::findOrFail($Codigo);
        $asignacion->delete();

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación eliminada correctamente.');
    }

    /**
     * Cambiar estado de asignación (acción especial)
     */
    public function cambiarEstado(Request $request, $Codigo)
    {
        $asignacion = AsignacionesInstructore::findOrFail($Codigo);

        $request->validate([
            'Estado' => 'required|in:Asignado,En curso,Finalizado,Cancelado'
        ]);

        $asignacion->update(['Estado' => $request->Estado]);

        return redirect()->back()->with('success', 'Estado de asignación actualizado.');
    }
}
