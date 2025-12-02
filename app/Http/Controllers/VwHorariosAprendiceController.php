<?php

namespace App\Http\Controllers;

use App\Models\VwHorariosAprendice;
use Illuminate\Http\Request;

class VwHorariosAprendiceController extends Controller
{
    /* ============================================================
       LISTA GENERAL DE HORARIOS (AJAX + FILTROS)
    ============================================================ */
    /**
     * Muestra la lista de horarios.
     * Soporta filtros dinámicos (documento, ficha, fechas) y paginación.
     * Si la petición es AJAX, devuelve JSON, de lo contrario devuelve la vista.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = VwHorariosAprendice::query();

        // Aplicar filtros dinámicos
        $filters = ['documento' => 'apr_NumeroDocumento', 'ficha' => 'ficha_codigo'];
        foreach ($filters as $param => $column) {
            if ($request->filled($param)) {
                $query->where($column, 'like', "%{$request->$param}%");
            }
        }

        // Filtro por fecha o rango
        if ($request->filled('fecha')) {
            $query->whereDate('fecha_inicio', $request->fecha);
        } elseif ($request->filled('desde') && $request->filled('hasta')) {
            $query->whereBetween('fecha_inicio', [$request->desde, $request->hasta]);
        }

        $query->orderBy('fecha_inicio', 'asc');

        // Paginación
        $horarios = $query->paginate(15);

        // Obtener datos para los filtros select2
        $aprendices = VwHorariosAprendice::select('aprendiz_id','apr_PrimerNombre','apr_Apellidos')->distinct()->get();
        $fichas = VwHorariosAprendice::select('ficha_codigo')->distinct()->get();
        $instructores = VwHorariosAprendice::select('instructor')->distinct()->get();

        // Pasar todo a la vista
        return view('horarios.index', compact('horarios','aprendices','fichas','instructores'));
    }


    /* ============================================================
       HORARIOS POR APRENDIZ / FICHA / EVENTO
    ============================================================ */
    public function porAprendiz($id)
    {
        $horarios = VwHorariosAprendice::where('aprendiz_id', $id)->get();
        return response()->json($horarios);
    }

    public function porFicha($ficha)
    {
        $horarios = VwHorariosAprendice::where('ficha_codigo', $ficha)->get();
        return response()->json($horarios);
    }

    public function porEvento($eventoId)
    {
        $horarios = VwHorariosAprendice::where('evento_id', $eventoId)->get();
        return response()->json($horarios);
    }

    public function porFecha(Request $request)
    {
        $request->validate(['fecha' => 'required|date']);
        $horarios = VwHorariosAprendice::whereDate('fecha_inicio', $request->fecha)->get();
        return response()->json($horarios);
    }

    public function porRango(Request $request)
    {
        $request->validate(['desde' => 'required|date', 'hasta' => 'required|date']);
        $horarios = VwHorariosAprendice::whereBetween('fecha_inicio', [$request->desde, $request->hasta])->get();
        return response()->json($horarios);
    }

    /* ============================================================
       VISTA: CALENDARIO FULLCALENDAR
    ============================================================ */
    public function calendario()
    {
        return view('horarios.calendario');
    }

    /* ============================================================
       DATOS PARA FULLCALENDAR (JSON)
    ============================================================ */
    /**
     * Devuelve los horarios en formato JSON para FullCalendar.
     * Incluye propiedades extendidas como ambiente, instructor, competencia,
     * y color según tipo de evento.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function calendarioData()
    {
        $eventos = VwHorariosAprendice::select(
            'evento_id',
            'evento_titulo',
            'fecha_inicio',
            'fecha_fin',
            'ambiente',
            'instructor',
            'competencia',
            'tipo_evento' // opcional para definir color
        )->get();

        $data = $eventos->map(function ($h) {
            // Asignar color según tipo de evento
            $color = match($h->tipo_evento ?? 'default') {
                'teorico' => '#3498db',
                'practico' => '#2ecc71',
                'administrativo' => '#e67e22',
                default => '#95a5a6',
            };

            return [
                'id'    => $h->evento_id,
                'title' => $h->evento_titulo,
                'start' => $h->fecha_inicio,
                'end'   => $h->fecha_fin,
                'color' => $color,
                'extendedProps' => [
                    'ambiente'    => $h->ambiente,
                    'instructor'  => $h->instructor,
                    'competencia' => $h->competencia,
                ],
            ];
        });

        return response()->json($data);
    }
}
