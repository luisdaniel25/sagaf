<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolicitudStoreRequest;
use App\Http\Requests\SolicitudUpdateRequest;
use App\Http\Requests\SolicitudRechazarRequest;
use App\Models\Competencia;
use App\Models\FichaCaracterizacion;
use App\Models\Solicitud;
use App\Services\SolicitudService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SolicitudCompetenciaController extends Controller
{
    public function __construct(
        private readonly SolicitudService $service
    ) {
    }

    public function create(): View
    {
        return view('solicitudes.create', [
            'competencias' => Competencia::where(
                'comp_Tipo',
                'Transversal'
            )->get(),

            'fichas' => FichaCaracterizacion::all(),
        ]);
    }

    public function store(
        SolicitudStoreRequest $request
    ): RedirectResponse {

        $this->service->crearSolicitud(
            $request->validated()
        );

        return redirect()
            ->route('solicitudes.mis-solicitudes')
            ->with(
                'success',
                'Solicitud enviada exitosamente.'
            );
    }

    public function edit(
        Solicitud $solicitud
    ): View {

        $this->service->verificarPropietario(
            $solicitud
        );

        return view('solicitudes.edit', [
            'solicitud' => $solicitud,

            'competencias' => Competencia::where(
                'comp_Tipo',
                'Transversal'
            )->get(),

            'fichas' => FichaCaracterizacion::all(),
        ]);
    }

    public function update(
        SolicitudUpdateRequest $request,
        Solicitud $solicitud
    ): RedirectResponse {

        $this->service->actualizarSolicitud(
            $solicitud,
            $request->validated()
        );

        return redirect()
            ->route('solicitudes.mis-solicitudes')
            ->with(
                'success',
                'Solicitud actualizada exitosamente.'
            );
    }

    public function misSolicitudes(): View
    {
        $solicitudes = $this->service
            ->obtenerMisSolicitudes();

        return view(
            'solicitudes.mis-solicitudes',
            compact('solicitudes')
        );
    }

    public function indexCoordinador(): View
    {
        $solicitudes = Solicitud::with([
            'instructor',
            'competencia',
            'ficha'
        ])
            ->latest('sol_FechaSolicitud')
            ->paginate(15);

        return view(
            'coordinador.solicitudes',
            compact('solicitudes')
        );
    }

    public function show(
        Solicitud $solicitud
    ): View {

        $solicitud->load([
            'instructor',
            'competencia',
            'ficha'
        ]);

        return view(
            'solicitudes.show',
            compact('solicitud')
        );
    }

    public function aprobar(
        Solicitud $solicitud
    ): RedirectResponse {

        $this->service->aprobar(
            $solicitud
        );

        return back()->with(
            'success',
            'Solicitud aprobada exitosamente.'
        );
    }

    public function rechazar(
        SolicitudRechazarRequest $request,
        Solicitud $solicitud
    ): RedirectResponse {

        $this->service->rechazar(
            $solicitud,
            $request->sol_Observaciones
        );

        return back()->with(
            'success',
            'Solicitud rechazada exitosamente.'
        );
    }
}
