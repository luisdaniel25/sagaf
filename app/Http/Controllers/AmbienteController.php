<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ambientes\AmbienteRequestCreate;
use App\Http\Requests\Ambientes\AmbienteRequestUpdate;
use App\Models\Ambiente;
use App\Models\EstadoAmbiente;
use App\Models\TipoAmbiente;
use App\Services\AmbienteService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AmbienteController extends Controller
{
    public function __construct(
        private readonly AmbienteService $service
    ) {
    }

    public function index(Request $request): View
    {
        $tipos = TipoAmbiente::query()
            ->orderBy('tip_Denominacion')
            ->get();

        $estados = EstadoAmbiente::query()
            ->orderBy('est_Denominacion')
            ->get();

        $query = Ambiente::query()
            ->with([
                'tipo_ambiente',
                'estado_ambiente'
            ]);

        if ($request->filled('search')) {
            $query->where(
                'amb_Denominacion',
                'like',
                "%{$request->search}%"
            );
        }

        if ($request->filled('estado')) {
            $query->where(
                'Codigo_estado',
                $request->estado
            );
        }

        if ($request->filled('tipo')) {
            $query->where(
                'Codigo_tipo',
                $request->tipo
            );
        }

        $ambientes = $query
            ->latest('Codigo')
            ->paginate(10)
            ->withQueryString();

        return view(
            'ambientes.index',
            compact('ambientes', 'tipos', 'estados')
        );
    }

    public function create(): View
    {
        $tipos = TipoAmbiente::query()
            ->orderBy('tip_Denominacion')
            ->get();

        $estados = EstadoAmbiente::query()
            ->orderBy('est_Denominacion')
            ->get();

        return view(
            'ambientes.create',
            compact('tipos', 'estados')
        );
    }

    public function store(
        AmbienteRequestCreate $request
    ): RedirectResponse {
        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('ambientes.index')
            ->with(
                'success',
                'Ambiente creado correctamente.'
            );
    }

    public function show(
        Ambiente $ambiente
    ): View {
        $ambiente->load([
            'tipo_ambiente',
            'estado_ambiente',
            'asignaciones_instructores.instructor',
            'asignaciones_instructores.ficha_caracterizacion',
        ]);

        return view(
            'ambientes.show',
            compact('ambiente')
        );
    }

    public function edit(
        Ambiente $ambiente
    ): View {
        $tipos = TipoAmbiente::query()
            ->orderBy('tip_Denominacion')
            ->get();

        $estados = EstadoAmbiente::query()
            ->orderBy('est_Denominacion')
            ->get();

        return view(
            'ambientes.edit',
            compact(
                'ambiente',
                'tipos',
                'estados'
            )
        );
    }

    public function update(
        AmbienteRequestUpdate $request,
        Ambiente $ambiente
    ): RedirectResponse {
        $this->service->update(
            $ambiente,
            $request->validated()
        );

        return redirect()
            ->route('ambientes.index')
            ->with(
                'success',
                'Ambiente actualizado correctamente.'
            );
    }

    public function destroy(
        Ambiente $ambiente
    ): RedirectResponse {
        $this->service->delete($ambiente);

        return redirect()
            ->route('ambientes.index')
            ->with(
                'success',
                'Ambiente eliminado correctamente.'
            );
    }

    public function ponerEnMantenimiento(
        Ambiente $ambiente
    ): RedirectResponse {
        $this->service->ponerEnMantenimiento(
            $ambiente
        );

        return redirect()
            ->route('ambientes.index')
            ->with(
                'success',
                'Ambiente puesto en mantenimiento correctamente.'
            );
    }

    public function liberar(
        Ambiente $ambiente
    ): RedirectResponse {
        $this->service->liberar(
            $ambiente
        );

        return redirect()
            ->route('ambientes.index')
            ->with(
                'success',
                'Ambiente liberado correctamente.'
            );
    }
}
