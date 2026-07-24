@extends('adminlte::page')

@section('title', 'Detalle del Evento')

@section('content_header')
    <h1>Detalle del Evento</h1>
@stop

@section('content')

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">{{ $evento->title }}</h3>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <strong>Título</strong>

                    <p>{{ $evento->title }}</p>

                </div>

                <div class="col-md-6">

                    <strong>Descripción</strong>

                    <p>{{ $evento->descripcion ?: 'Sin descripción' }}</p>

                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-6">

                    <strong>Fecha y Hora Inicio</strong>

                    <p>
                        {{ optional($evento->start)->format('d/m/Y H:i') ?? 'N/A' }}
                    </p>

                </div>

                <div class="col-md-6">

                    <strong>Fecha y Hora Fin</strong>

                    <p>
                        {{ optional($evento->end)->format('d/m/Y H:i') ?? 'N/A' }}
                    </p>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <strong>Hora Inicio</strong>

                    <p>{{ $evento->horaInicio }}</p>

                </div>

                <div class="col-md-6">

                    <strong>Hora Final</strong>

                    <p>{{ $evento->horaFinal }}</p>

                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-6">

                    <strong>Instructor</strong>

                    <p>{{ optional($evento->instructor)->Nombre ?? 'N/A' }}</p>

                </div>

                <div class="col-md-6">

                    <strong>Ficha</strong>

                    <p>{{ optional($evento->ficha_caracterizacion)->Codigo ?? 'N/A' }}</p>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <strong>Ambiente</strong>

                    <p>{{ optional($evento->ambiente)->Nombre_ambiente ?? 'N/A' }}</p>

                </div>

                <div class="col-md-6">

                    <strong>Competencia</strong>

                    <p>{{ optional($evento->competencia)->Nombre_competencia ?? 'N/A' }}</p>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <strong>Resultado de Aprendizaje</strong>

                    <p>
                        {{ optional($evento->resultado_aprendizaje)->Descripcion ?? 'N/A' }}
                    </p>

                </div>

            </div>

        </div>

        <div class="card-footer">

            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Volver
            </a>

            <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                Editar
            </a>

            <form action="{{ route('eventos.destroy', $evento->id) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('¿Desea eliminar este evento?')">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    Eliminar
                </button>

            </form>

        </div>

    </div>

@stop
