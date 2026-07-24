<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramaStoreRequest;
use App\Http\Requests\ProgramaUpdateRequest;
use App\Models\Programa;
use App\Services\ProgramaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProgramaFormacionController extends Controller
{
    public function __construct(
        private readonly ProgramaService $service
    ) {
    }

    public function index(): View
    {
        $programasFormacion = Programa::query()
            ->latest('prog_codigoPrograma')
            ->paginate(10);

        return view(
            'programas.index',
            compact('programasFormacion')
        );
    }

    public function create(): View
    {
        return view('programas.create');
    }

    public function store(
        ProgramaStoreRequest $request
    ): RedirectResponse {

        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('programas.index')
            ->with(
                'success',
                'Programa creado exitosamente.'
            );
    }

    public function show(
        Programa $programa
    ): View {

        return view(
            'programas.show',
            compact('programa')
        );
    }

    public function edit(
        Programa $programa
    ): View {

        return view(
            'programas.edit',
            compact('programa')
        );
    }

    public function update(
        ProgramaUpdateRequest $request,
        Programa $programa
    ): RedirectResponse {

        $this->service->update(
            $programa,
            $request->validated()
        );

        return redirect()
            ->route('programas.index')
            ->with(
                'success',
                'Programa actualizado exitosamente.'
            );
    }

    public function destroy(
        Programa $programa
    ): RedirectResponse {

        $this->service->delete($programa);

        return redirect()
            ->route('programas.index')
            ->with(
                'success',
                'Programa eliminado exitosamente.'
            );
    }
}
