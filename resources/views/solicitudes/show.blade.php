@extends('adminlte::page')

@section('title', 'Detalle de Solicitud')

@section('content_header')
    <h1>Detalle de la Solicitud</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Información de la Solicitud</strong>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Instructor:</strong> {{ optional($solicitud->instructor)->ins_NombreCompleto ?? 'N/A' }}</p>
                    <p><strong>Ficha:</strong> {{ optional($solicitud->ficha)->nombre ?? $solicitud->Codigo_ficha }}</p>
                    <p><strong>Competencia:</strong> {{ optional($solicitud->competencia)->comp_Denominacion ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Estado:</strong>
                        <span class="badge
                        @if($solicitud->sol_Estado == 'Pendiente') bg-warning
                        @elseif($solicitud->sol_Estado == 'Aprobada') bg-success
                        @else bg-danger
                        @endif">
                        {{ $solicitud->sol_Estado }}
                    </span>
                    </p>
                    <p><strong>Fecha Solicitud:</strong> {{ $solicitud->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Horas solicitadas:</strong> {{ $solicitud->sol_HorasSolicitadas }}</p>
                </div>
            </div>

            <hr>

            <p><strong>Justificación:</strong></p>
            <p>{{ $solicitud->sol_Justificacion }}</p>

            @if($solicitud->sol_Estado == 'Rechazada')
                <hr>
                <p><strong>Observaciones del Coordinador:</strong></p>
                <p>{{ $solicitud->sol_Observaciones }}</p>
            @endif
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>

            @if(auth()->user()->rol == 'Coordinador' && $solicitud->sol_Estado == 'Pendiente')
                <div>
                    <form action="{{ route('coordinador.solicitudes.aprobar', $solicitud) }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="return confirm('¿Aprobar esta solicitud?')">Aprobar</button>
                    </form>

                    <button class="btn btn-danger" data-toggle="modal" data-target="#modalRechazo">Rechazar</button>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal para rechazo --}}
    <div class="modal fade" id="modalRechazo">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('coordinador.solicitudes.rechazar', $solicitud) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Rechazar Solicitud</h4>
                    </div>

                    <div class="modal-body">
                        <label>Observaciones:</label>
                        <textarea name="sol_Observaciones" class="form-control" required rows="4"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Rechazar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
