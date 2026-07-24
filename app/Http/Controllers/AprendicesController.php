<?php

namespace App\Http\Controllers;

use App\Http\Requests\AprendizStoreRequest;
use App\Http\Requests\AprendizUpdateRequest;
use App\Models\Aprendiz;
use App\Models\CentroFormacion;
use App\Models\FichaCaracterizacion;
use App\Models\Programa;
use App\Models\Regionale;
use App\Services\AprendizService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AprendicesController extends Controller
{
    public function __construct(
        private readonly AprendizService $service
    ) {
    }

    public function index(): View
    {
        $aprendices = Aprendiz::query()
            ->with([
                'centro_formacion',
                'ficha_caracterizacion',
                'programa',
                'regionale'
            ])
            ->paginate(10);

        return view(
            'aprendices.index',
            compact('aprendices')
        );
    }

    public function show(
        Aprendiz $aprendiz
    ): View {
        $aprendiz->load([
            'centro_formacion',
            'ficha_caracterizacion',
            'programa',
            'regionale'
        ]);

        return view(
            'aprendices.show',
            compact('aprendiz')
        );
    }

    public function create(): View
    {
        return view('aprendices.create', [
            'programas' => Programa::orderBy('prog_Denominacion')->get(),
            'fichas' => FichaCaracterizacion::orderBy('Codigo')->get(),
            'centros' => CentroFormacion::orderBy('cen_Denominacion')->get(),
            'regionales' => Regionale::orderBy('reg_Denominacion')->get(),
        ]);
    }

    public function store(
        AprendizStoreRequest $request
    ): RedirectResponse {

        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('aprendices.index')
            ->with(
                'success',
                'Aprendiz creado correctamente.'
            );
    }

    public function edit(
        Aprendiz $aprendiz
    ): View {

        return view('aprendices.edit', [
            'aprendiz' => $aprendiz,
            'programas' => Programa::orderBy('prog_Denominacion')->get(),
            'fichas' => FichaCaracterizacion::orderBy('Codigo')->get(),
            'centros' => CentroFormacion::orderBy('cen_Denominacion')->get(),
            'regionales' => Regionale::orderBy('reg_Denominacion')->get(),
        ]);
    }

    public function update(
        AprendizUpdateRequest $request,
        Aprendiz $aprendiz
    ): RedirectResponse {

        $this->service->update(
            $aprendiz,
            $request->validated()
        );

        return redirect()
            ->route('aprendices.index')
            ->with(
                'success',
                'Aprendiz actualizado correctamente.'
            );
    }

    public function destroy(
        Aprendiz $aprendiz
    ): RedirectResponse {

        $this->service->delete($aprendiz);

        return redirect()
            ->route('aprendices.index')
            ->with(
                'success',
                'Aprendiz eliminado correctamente.'
            );
    }
}
