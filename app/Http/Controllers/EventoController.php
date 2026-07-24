<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoStoreRequest;
use App\Http\Requests\EventoUpdateRequest;
use App\Models\Evento;
use App\Services\EventoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EventoController extends Controller
{
    public function __construct(
        private readonly EventoService $service
    ) {
    }

    public function index(): View
    {
        $eventos = Evento::query()
            ->with([
                'ambiente',
                'competencia',
                'ficha',
                'instructor',
                'resultadoAprendizaje'
            ])
            ->latest('Codigo')
            ->paginate(15);

        return view(
            'eventos.index',
            compact('eventos')
        );
    }

    public function create(): View
    {
        return view('eventos.create');
    }

    public function store(
        EventoStoreRequest $request
    ): RedirectResponse {

        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('eventos.index')
            ->with(
                'success',
                'Evento creado correctamente.'
            );
    }

    public function show(
        Evento $evento
    ): View {

        $evento->load([
            'ambiente',
            'competencia',
            'ficha',
            'instructor',
            'resultadoAprendizaje'
        ]);

        return view(
            'eventos.show',
            compact('evento')
        );
    }

    public function edit(
        Evento $evento
    ): View {

        return view(
            'eventos.edit',
            compact('evento')
        );
    }

    public function update(
        EventoUpdateRequest $request,
        Evento $evento
    ): RedirectResponse {

        $this->service->update(
            $evento,
            $request->validated()
        );

        return redirect()
            ->route('eventos.index')
            ->with(
                'success',
                'Evento actualizado correctamente.'
            );
    }

    public function destroy(
        Evento $evento
    ): RedirectResponse {

        $this->service->delete($evento);

        return redirect()
            ->route('eventos.index')
            ->with(
                'success',
                'Evento eliminado correctamente.'
            );
    }
}
