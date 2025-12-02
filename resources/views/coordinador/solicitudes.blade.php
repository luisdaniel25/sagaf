@extends('adminlte::page')

@section('title', 'Solicitudes de Programación')

@section('content_header')
    <h1>Solicitudes de Programación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Lista de Solicitudes</span>
            <a href="{{ route('solicitudes.create') }}" class="btn btn-primary btn-sm">Nueva Solicitud</a>
        </div>

        <div class="card-body">
            @if($solicitudes->isEmpty())
                <p>No hay solicitudes registradas.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Instructor / Ficha</th>
                        <th>Competencia</th>
                        <th>Estado</th>
                        <th>Fecha de Solicitud</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{{ optional($solicitud->instructor)->ins_NombreCompleto ?? 'N/A' }} / {{ optional($solicitud->ficha)->nombre ?? $solicitud->Codigo_ficha }}</td>
                            <td>{{ optional($solicitud->competencia)->comp_Denominacion ?? 'N/A' }}</td>
                            <td>
                            <span class="badge
                                @if($solicitud->sol_Estado == 'Pendiente') bg-warning
                                @elseif($solicitud->sol_Estado == 'Aprobada') bg-success
                                @else bg-danger
                                @endif">
                                {{ $solicitud->sol_Estado }}
                            </span>
                            </td>
                            <td>{{ $solicitud->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('solicitudes.show', $solicitud) }}" class="btn btn-info btn-sm">Ver</a>
                                @if($solicitud->sol_Estado == 'Pendiente')
                                    <a href="{{ route('solicitudes.edit', $solicitud) }}" class="btn btn-warning btn-sm">Editar</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@stop
