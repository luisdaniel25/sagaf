@extends('adminlte::page')

@section('title', 'Detalle del Evento')

@section('content_header')
    <h1>Detalle del Evento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label><strong>Título:</strong></label>
                    <p>{{ $evento->title }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Descripción:</strong></label>
                    <p>{{ $evento->descripcion }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label><strong>Fecha y Hora Inicio:</strong></label>
                    <p>{{ $evento->start->format('Y-m-d H:i') }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Fecha y Hora Fin:</strong></label>
                    <p>{{ $evento->end->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label><strong>Hora Inicio:</strong></label>
                    <p>{{ $evento->horaInicio }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Hora Final:</strong></label>
                    <p>{{ $evento->horaFinal }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label><strong>Instructor:</strong></label>
                    <p>{{ $evento->instructor->Nombre ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Ficha:</strong></label>
                    <p>{{ $evento->ficha_caracterizacion->Codigo ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label><strong>Ambiente:</strong></label>
                    <p>{{ $evento->ambiente->Nombre_ambiente ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Competencia:</strong></label>
                    <p>{{ $evento->competencia->Nombre_competencia ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label><strong>Resultado de Aprendizaje:</strong></label>
                    <p>{{ $evento->resultado_aprendizaje->Descripcion ?? 'N/A' }}</p>
                </div>
            </div>

            <a href="{{ route('eventos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
            <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>

        </div>
    </div>
@stop
