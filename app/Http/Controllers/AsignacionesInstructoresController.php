<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsignacionStoreRequest;
use App\Http\Requests\AsignacionUpdateRequest;
use App\Models\Ambiente;
use App\Models\AsignacionesInstructore;
use App\Models\Competencia;
use App\Models\FichaCaracterizacion;
use App\Models\Instructor;
use App\Services\AsignacionInstructorService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AsignacionesInstructoresController extends Controller
{
    public function __construct(
        private readonly AsignacionInstructorService $service
    ) {
    }

    public function index(): View
    {
        $asignaciones = AsignacionesInstructore::query()
            ->with([
                'instructor',
                'ficha_caracterizacion',
                'competencia',
                'ambiente',
            ])
            ->latest('Codigo')
            ->paginate(10);

        return view(
            'asignaciones.index',
            compact('asignaciones')
        );
    }

    public function create(): View
    {
        return view('asignaciones.create', [
            'instructores' => Instructor::orderBy('inst_Nombres')->get(),
            'fichas' => FichaCaracterizacion::with('programa')
                ->orderBy('Codigo')
                ->get(),
            'competencias' => Competencia::orderBy('comp_Denominacion')->get(),
            'ambientes' => Ambiente::with('tipo_ambiente')
                ->where('Codigo_estado', '!=', 3)
                ->orderBy('amb_Denominacion')
                ->get(),
        ]);
    }

    public function store(
        AsignacionStoreRequest $request
    ): RedirectResponse {

        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('asignaciones.index')
            ->with(
                'success',
                'Asignación creada correctamente.'
            );
    }

    public function show(
        AsignacionesInstructore $asignacione
    ): View {

        $asignacione->load([
            'instructor',
            'ficha_caracterizacion.programa',
            'competencia',
            'ambiente.tipo_ambiente',
            'notificaciones'
        ]);

        return view(
            'asignaciones.show',
            [
                'asignacion' => $asignacione
            ]
        );
    }

    public function edit(
        AsignacionesInstructore $asignacione
    ): View {

        return view('asignaciones.edit', [
            'asignacion' => $asignacione,
            'instructores' => Instructor::orderBy('inst_Nombres')->get(),
            'fichas' => FichaCaracterizacion::with('programa')
                ->orderBy('Codigo')
                ->get(),
            'competencias' => Competencia::orderBy('comp_Denominacion')->get(),
            'ambientes' => Ambiente::with('tipo_ambiente')
                ->orderBy('amb_Denominacion')
                ->get(),
        ]);
    }

    public function update(
        AsignacionUpdateRequest $request,
        AsignacionesInstructore $asignacione
    ): RedirectResponse {

        $this->service->update(
            $asignacione,
            $request->validated()
        );

        return redirect()
            ->route('asignaciones.index')
            ->with(
                'success',
                'Asignación actualizada correctamente.'
            );
    }

    public function destroy(
        AsignacionesInstructore $asignacione
    ): RedirectResponse {

        $this->service->delete(
            $asignacione
        );

        return redirect()
            ->route('asignaciones.index')
            ->with(
                'success',
                'Asignación eliminada correctamente.'
            );
    }

    public function cambiarEstado(
        Request $request,
        AsignacionesInstructore $asignacione
    ): RedirectResponse {

        $request->validate([
            'Estado' => [
                'required',
                'in:Asignado,En curso,Finalizado,Cancelado'
            ]
        ]);

        $this->service->cambiarEstado(
            $asignacione,
            $request->Estado
        );

        return back()->with(
            'success',
            'Estado actualizado correctamente.'
        );
    }
}
