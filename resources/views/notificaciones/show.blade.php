@extends('adminlte::page')

@section('title', 'Detalle de Notificación')

@section('content_header')
    <h1>Detalle de Notificación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Título:</strong> {{ $notificacion->not_Titulo }}</p>
            <p><strong>Mensaje:</strong> {{ $notificacion->not_Mensaje }}</p>
            <p><strong>Tipo:</strong> {{ $notificacion->not_Tipo }}</p>
            <p><strong>Estado:</strong> {{ $notificacion->not_Estado }}</p>
            <p><strong>Referencia:</strong> {{ $notificacion->Codigo_referencia ?? '-' }}</p>
            <p><strong>Creado:</strong> {{ $notificacion->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Actualizado:</strong> {{ $notificacion->updated_at->format('d/m/Y H:i') }}</p>
            <a href="{{ route('notificaciones.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@stop
