@extends('adminlte::page')

@section('title', 'Detalles del Ambiente')

@section('content_header')
    <h1>Detalles del Ambiente</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header">
            <a href="{{ route('ambientes.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- Código -->
                <div class="col-md-4">
                    <x-adminlte-input
                        name="codigo"
                        label="Código"
                        value="{{ $ambiente->Codigo }}"
                        disabled
                    />
                </div>

                <!-- Denominación -->
                <div class="col-md-8">
                    <x-adminlte-input
                        name="denominacion"
                        label="Denominación"
                        value="{{ $ambiente->amb_Denominacion }}"
                        disabled
                    />
                </div>

                <!-- Cupo -->
                <div class="col-md-4">
                    <x-adminlte-input
                        name="cupo"
                        label="Cupo"
                        value="{{ $ambiente->amb_Cupo }}"
                        disabled
                    />
                </div>

                <!-- Tipo de Ambiente -->
                <div class="col-md-4">
                    <x-adminlte-input
                        name="tipo_ambiente"
                        label="Tipo de Ambiente"
                        value="{{ $ambiente->tipo->tip_Denominacion ?? 'Sin definir' }}"
                        disabled
                    />
                </div>

                <!-- Estado -->
                <div class="col-md-4">
                    <x-adminlte-input
                        name="estado"
                        label="Estado"
                        value="{{ $ambiente->estado->est_Denominacion ?? 'Desconocido' }}"
                        disabled
                    />
                </div>

            </div>

            <hr>

            <div class="mt-3">
                <a href="{{ route('ambientes.edit', $ambiente->Codigo) }}" class="btn btn-info">
                    <i class="fas fa-edit"></i> Editar
                </a>

                <form action="{{ route('ambientes.destroy', $ambiente->Codigo) }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger" onclick="return confirm('¿Seguro de eliminar?')">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>

        </div>

    </div>

@stop
