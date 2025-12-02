@extends('adminlte::page')

@section('title', 'Detalle del Ambiente')

@section('content_header')
    <h1>Detalle del Ambiente: {{ $ambiente->amb_Denominacion }}</h1>
@stop

@section('content')
    <div class="container">

        <div class="mb-3">
            <a href="{{ route('estados.index') }}" class="btn btn-secondary">Volver al listado</a>
            <a href="{{ route('ambientes.edit', $ambiente->Codigo) }}" class="btn btn-warning">Editar Ambiente</a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Información General
            </div>
            <div class="card-body">
                <p><strong>Código:</strong> {{ $ambiente->Codigo }}</p>
                <p><strong>Denominación:</strong> {{ $ambiente->amb_Denominacion }}</p>
                <p><strong>Tipo:</strong> {{ $ambiente->tipo_ambiente->tip_Denominacion ?? 'N/A' }}</p>
                <p><strong>Cupo:</strong> {{ $ambiente->amb_Cupo }}</p>
                <p><strong>Estado:</strong>
                    @if($ambiente->Codigo_estado == 1)
                        <span class="badge bg-success">Libre</span>
                    @elseif($ambiente->Codigo_estado == 2)
                        <span class="badge bg-danger">Ocupado</span>
                    @elseif($ambiente->Codigo_estado == 3)
                        <span class="badge bg-warning text-dark">Mantenimiento</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Historial de Asignaciones
            </div>
            <div class="card-body">
                @if($ambiente->asignaciones_instructores->count() > 0)
                    <table class="table table-bordered
