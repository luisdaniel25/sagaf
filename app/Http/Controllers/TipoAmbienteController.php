<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoAmbienteStoreRequest;
use App\Http\Requests\TipoAmbienteUpdateRequest;
use App\Models\TipoAmbiente;
use App\Services\TipoAmbienteService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TipoAmbienteController extends Controller
{
    public function __construct(
        private readonly TipoAmbienteService $service
    ) {
    }

    public function index(): View
    {
        $tipos = TipoAmbiente::query()
            ->latest('Codigo')
            ->paginate(10);

        return view(
            'tipo-ambientes.index',
            compact('tipos')
        );
    }

    public function create(): View
    {
        return view('tipo-ambientes.create');
    }

    public function store(
        TipoAmbienteStoreRequest $request
    ): RedirectResponse {

        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('tipo-ambientes.index')
            ->with(
                'success',
                'El tipo de ambiente se creó correctamente.'
            );
    }

    public function show(
        TipoAmbiente $tipoAmbiente
    ): View {

        return view(
            'tipo-ambientes.show',
            [
                'tipo' => $tipoAmbiente
            ]
        );
    }

    public function edit(
        TipoAmbiente $tipoAmbiente
    ): View {

        return view(
            'tipo-ambientes.edit',
            [
                'tipo' => $tipoAmbiente
            ]
        );
    }

    public function update(
        TipoAmbienteUpdateRequest $request,
        TipoAmbiente $tipoAmbiente
    ): RedirectResponse {

        $this->service->update(
            $tipoAmbiente,
            $request->validated()
        );

        return redirect()
            ->route('tipo-ambientes.index')
            ->with(
                'success',
                'El tipo de ambiente se actualizó correctamente.'
            );
    }

    public function destroy(
        TipoAmbiente $tipoAmbiente
    ): RedirectResponse {

        $this->service->delete(
            $tipoAmbiente
        );

        return redirect()
            ->route('tipo-ambientes.index')
            ->with(
                'success',
                'El tipo de ambiente se eliminó correctamente.'
            );
    }
}
