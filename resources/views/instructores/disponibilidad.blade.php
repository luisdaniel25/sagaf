@extends('adminlte::page')

@section('title', 'Disponibilidad del Instructor')

@section('content_header')
    <h1>Disponibilidad y Competencias de {{ $instructor->inst_Nombres }} {{ $instructor->inst_Apellido }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Disponibilidad</div>
                <div class="card-body">
                    @if($disponibilidades->count() > 0)
                        <ul class="list-group">
                            @foreach($disponibilidades as $disponibilidad)
                                <li class="list-group-item">
                                    {{ ucfirst($disponibilidad->dia_semana) }}:
                                    {{ \Carbon\Carbon::parse($disponibilidad->hora_inicio)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($disponibilidad->hora_fin)->format('H:i') }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No hay disponibilidad registrada</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Competencias Asignadas</div>
                <div class="card-body">
                    @if($competencias->count() > 0)
                        <ul class="list-group">
                            @foreach($competencias as $competencia)
                                <li class="list-group-item">
                                    {{ $competencia->comp_Denominacion }} ({{ $competencia->comp_Tipo }})
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No tiene competencias asignadas</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('instructores.show', $instructor->Codigo) }}" class="btn btn-secondary">Volver</a>
    </div>
@stop
