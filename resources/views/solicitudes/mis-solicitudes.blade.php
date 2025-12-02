@extends('adminlte::page')

@section('title', 'Mis Solicitudes')

@section('content_header')
    <h1>Mis Solicitudes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('solicitudes.create') }}" class="btn btn-primary btn-sm">Nueva Solicitud</a>
        </div>

        <div class="card-body">
            @if($solicitudes->isEmpty())
                <p>No has enviado solicitudes.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Ficha</th>
                        <th>Competencia</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{{ optional($solicitud->ficha)->nombre ?? $solicitud->Codigo_ficha }}</td>
                            <td>{{ optional($solicitud->competencia)->comp_Denominacion ?? 'N/A' }}</td>
                            <td>{{ $solicitud->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                            <span class="badge
                                @if($solicitud->sol_Estado == 'Pendiente') bg-warning
                                @elseif($solicitud->sol_Estado == 'Aprobada') bg-success
                                @else bg-danger
                                @endif">
                                {{ $solicitud->sol_Estado }}
                            </span>
                            </td>
                            <td>
                                <a href="{{ route('solicitudes.show', $solicitud) }}" class="btn btn-info btn-sm">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@stop
