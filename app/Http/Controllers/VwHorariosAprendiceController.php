<?php

namespace App\Http\Controllers;

use App\Http\Requests\HorarioFechaRequest;
use App\Http\Requests\HorarioRangoRequest;
use App\Models\VwHorariosAprendice;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VwHorariosAprendiceController extends Controller
{
    public function index(
        Request $request
    ): View {

        $query = VwHorariosAprendice::query();

        if ($request->filled('documento')) {
            $query->where(
                'apr_NumeroDocumento',
                'like',
                "%{$request->documento}%"
            );
        }

        if ($request->filled('ficha')) {
            $query->where(
                'ficha_codigo',
                'like',
                "%{$request->ficha}%"
            );
        }

        if ($request->filled('fecha')) {

            $query->whereDate(
                'fecha_inicio',
                $request->fecha
            );

        } elseif (
            $request->filled('desde')
            &&
            $request->filled('hasta')
        ) {

            $query->whereBetween(
                'fecha_inicio',
                [
                    $request->desde,
                    $request->hasta
                ]
            );
        }

        $horarios = $query
            ->orderBy('fecha_inicio')
            ->paginate(15)
            ->withQueryString();

        return view('horarios.index', [
            'horarios' => $horarios,
            'aprendices' => $this->aprendices(),
            'fichas' => $this->fichas(),
            'instructores' => $this->instructores(),
        ]);
    }

    public function porAprendiz(
        int $id
    ): JsonResponse {

        return response()->json(
            VwHorariosAprendice::where(
                'aprendiz_id',
                $id
            )->get()
        );
    }

    public function porFicha(
        int $ficha
    ): JsonResponse {

        return response()->json(
            VwHorariosAprendice::where(
                'ficha_codigo',
                $ficha
            )->get()
        );
    }

    public function porEvento(
        int $eventoId
    ): JsonResponse {

        return response()->json(
            VwHorariosAprendice::where(
                'evento_id',
                $eventoId
            )->get()
        );
    }

    public function porFecha(
        HorarioFechaRequest $request
    ): JsonResponse {

        return response()->json(
            VwHorariosAprendice::whereDate(
                'fecha_inicio',
                $request->fecha
            )->get()
        );
    }

    public function porRango(
        HorarioRangoRequest $request
    ): JsonResponse {

        return response()->json(
            VwHorariosAprendice::whereBetween(
                'fecha_inicio',
                [
                    $request->desde,
                    $request->hasta
                ]
            )->get()
        );
    }

    public function calendario(): View
    {
        return view(
            'horarios.calendario'
        );
    }

    public function calendarioData(): JsonResponse
    {
        $eventos = VwHorariosAprendice::select(
            'evento_id',
            'evento_titulo',
            'fecha_inicio',
            'fecha_fin',
            'ambiente',
            'instructor',
            'competencia'
        )->get();

        $data = $eventos->map(
            fn ($evento) => [
                'id' => $evento->evento_id,
                'title' => $evento->evento_titulo,
                'start' => $evento->fecha_inicio,
                'end' => $evento->fecha_fin,

                'extendedProps' => [
                    'ambiente' => $evento->ambiente,
                    'instructor' => $evento->instructor,
                    'competencia' => $evento->competencia,
                ],
            ]
        );

        return response()->json(
            $data
        );
    }

    private function aprendices()
    {
        return VwHorariosAprendice::query()
            ->select(
                'aprendiz_id',
                'apr_PrimerNombre',
                'apr_Apellidos'
            )
            ->distinct()
            ->get();
    }

    private function fichas()
    {
        return VwHorariosAprendice::query()
            ->select('ficha_codigo')
            ->distinct()
            ->get();
    }

    private function instructores()
    {
        return VwHorariosAprendice::query()
            ->select('instructor')
            ->distinct()
            ->get();
    }
}
