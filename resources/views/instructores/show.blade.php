@extends('adminlte::page')

@section('title', 'Instructor')

@section('content_header')
    <h1>Detalles del Instructor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <h3>{{ $instructor->inst_Nombres }} {{ $instructor->inst_Apellido }}</h3>
            <hr>

            <p><strong>Identificación:</strong> {{ $instructor->inst_Identificacion }}</p>
            <p><strong>Correo:</strong> {{ $instructor->inst_Correo }}</p>
            <p><strong>Teléfono:</strong> {{ $instructor->inst_Telefono }}</p>
            <p><strong>Dirección:</strong> {{ $instructor->inst_Direccion }}</p>
            <p><strong>Vigencia:</strong>
                {{ $instructor->vigencia ? ($instructor->vigencia->vig_Estado ? 'Activa' : 'Inactiva') : 'No asignada' }}
            </p>

            <hr>

            <h4>Competencias</h4>
            <ul>
                @forelse ($instructor->competencias as $competencia)
                    <li>{{ $competencia->comp_Denominacion }}</li>
                @empty
                    <li>No tiene competencias asignadas</li>
                @endforelse
            </ul>

            <div class="mt-3">
                <a href="{{ route('instructores.competencias', $instructor->Codigo) }}"
                   class="btn btn-info btn-sm">
                    Gestionar Competencias
                </a>
                <a href="{{ route('instructores.disponibilidad', $instructor->Codigo) }}"
                   class="btn btn-warning btn-sm">
                    Ver Disponibilidad
                </a>
                <a href="{{ route('instructores.index') }}" class="btn btn-secondary">Volver</a>
            </div>

        </div>
    </div>
@stop
