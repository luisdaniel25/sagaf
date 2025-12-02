@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
    <h1>Notificaciones</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Lista de Notificaciones</span>
            <form action="{{ route('notificaciones.marcarTodasComoLeidas', auth()->id()) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Marcar todas como leídas</button>
            </form>
        </div>
        <div class="card-body">
            @if($notificaciones->isEmpty())
                <p>No hay notificaciones.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Mensaje</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notificaciones as $notificacion)
                        <tr @if($notificacion->not_Estado == 'No Leida') class="table-info" @endif>
                            <td>{{ $notificacion->not_Titulo }}</td>
                            <td>{{ Str::limit($notificacion->not_Mensaje, 50) }}</td>
                            <td>{{ $notificacion->not_Tipo }}</td>
                            <td>{{ $notificacion->not_Estado }}</td>
                            <td>{{ $notificacion->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('notificaciones.show', $notificacion) }}" class="btn btn-info btn-sm">Ver</a>
                                @if($notificacion->not_Estado != 'Leida')
                                    <form action="{{ route('notificaciones.marcarComoLeida', $notificacion) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm">Marcar como leída</button>
                                    </form>
                                @endif
                                <form action="{{ route('notificaciones.marcarComoArchivada', $notificacion) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-warning btn-sm">Archivar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $notificaciones->links() }}
            @endif
        </div>
    </div>
@stop
