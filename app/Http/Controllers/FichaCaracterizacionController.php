<?php

namespace App\Http\Controllers;

use App\Http\Requests\FichaStoreRequest;
use App\Http\Requests\FichaUpdateRequest;
use App\Models\CentroFormacion;
use App\Models\FichaCaracterizacion;
use App\Models\Modalidad;
use App\Models\Programa;
use App\Services\FichaCaracterizacionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FichaCaracterizacionController extends Controller
{
    public function __construct(
        private readonly FichaCaracterizacionService $service
    ) {
    }

    public function index(Request $request): View
    {
        $query = FichaCaracterizacion::query()
            ->with([
                'centro_formacion',
                'modalidad',
                'programa'
            ]);

        if ($request->filled('search')) {
            $query->where(
                'Codigo',
                'like',
                "%{$request->search}%"
            );
        }

        $fichas = $query
            ->latest('Codigo')
            ->paginate(10)
            ->withQueryString();

        return view(
            'fichas.index',
            compact('fichas')
        );
    }

    public function create(): View
    {
        return view(
            'fichas.create',
            $this->catalogos()
        );
    }

    public function store(
        FichaStoreRequest $request
    ): RedirectResponse {

        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('fichas.index')
            ->with(
                'success',
                'Ficha creada correctamente.'
            );
    }

    public function show(
        FichaCaracterizacion $ficha
    ): View {

        $ficha->load([
            'centro_formacion',
            'modalidad',
            'programa',
            'aprendizs'
        ]);

        return view(
            'fichas.show',
            compact('ficha')
        );
    }

    public function edit(
        FichaCaracterizacion $ficha
    ): View {

        return view(
            'fichas.edit',
            array_merge(
                ['ficha' => $ficha],
                $this->catalogos()
            )
        );
    }

    public function update(
        FichaUpdateRequest $request,
        FichaCaracterizacion $ficha
    ): RedirectResponse {

        $this->service->update(
            $ficha,
            $request->validated()
        );

        return redirect()
            ->route('fichas.index')
            ->with(
                'success',
                'Ficha actualizada correctamente.'
            );
    }

    public function destroy(
        FichaCaracterizacion $ficha
    ): RedirectResponse {

        $this->service->delete($ficha);

        return redirect()
            ->route('fichas.index')
            ->with(
                'success',
                'Ficha eliminada correctamente.'
            );
    }

    public function programasPorCentro(
        int $centroId
    ): JsonResponse {

        $programas = Programa::query()
            ->where(
                'Codigo_centro',
                $centroId
            )
            ->orderBy('prog_Denominacion')
            ->get();

        return response()->json(
            $programas
        );
    }

    private function catalogos(): array
    {
        return [
            'modalidades' => Modalidad::orderBy(
                'mod_Denominacion'
            )->get(),

            'centros' => CentroFormacion::orderBy(
                'cen_Denominacion'
            )->get(),

            'programas' => Programa::orderBy(
                'prog_Denominacion'
            )->get(),
        ];
    }
}
