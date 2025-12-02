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
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Aprendiz / Ficha</th>
                    <th>Competencia</th>
                    <th>Estado</th>
                    <th>Fecha de Solicitud</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->ficha->nombre ?? '-' }}</td>
                        <td>{{ $solicitud->competencia->comp_Denominacion ?? '-' }}</td>
                        <td>
                            @if($solicitud->sol_Estado == 'Pendiente')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @elseif($solicitud->sol_Estado == 'Aprobada')
                                <span class="badge bg-success">Aprobada</span>
                            @elseif($solicitud->sol_Estado == 'Rechazada')
                                <span class="badge bg-danger">Rechazada</span>
                            @else
                                <span class="badge bg-secondary">{{ $solicitud->sol_Estado }}</span>
                            @endif
                        </td>
                        <td>{{ $solicitud->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('solicitudes.show', $solicitud) }}" class="btn btn-info btn-sm" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($solicitud->sol_Estado == 'Pendiente')
                                <a href="{{ route('solicitudes.edit', $solicitud) }}" class="btn btn-warning btn-sm" title="Editar solicitud">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay solicitudes registradas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $solicitudes->links() }}
        </div>
    </div>
@stop
