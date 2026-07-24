@extends('adminlte::page')

@section('title', 'Detalles del Ambiente')

@section('content_header')
    <h1>Detalles del Ambiente</h1>
@stop

@section('content')

    <div class="card shadow-sm">

        <div class="card-header">

            <a href="{{ route('ambientes.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i>
                Volver
            </a>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4">

                    <x-adminlte-input
                        name="codigo"
                        label="Código"
                        value="{{ $ambiente->Codigo }}"
                        disabled>

                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-hashtag"></i>
                            </div>
                        </x-slot>

                    </x-adminlte-input>

                </div>

                <div class="col-md-8">

                    <x-adminlte-input
                        name="denominacion"
                        label="Denominación"
                        value="{{ $ambiente->amb_Denominacion }}"
                        disabled>

                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-building"></i>
                            </div>
                        </x-slot>

                    </x-adminlte-input>

                </div>

                <div class="col-md-4">

                    <x-adminlte-input
                        name="cupo"
                        label="Cupo"
                        value="{{ $ambiente->amb_Cupo }}"
                        disabled>

                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-users"></i>
                            </div>
                        </x-slot>

                    </x-adminlte-input>

                </div>

                <div class="col-md-4">

                    <x-adminlte-input
                        name="tipo_ambiente"
                        label="Tipo de Ambiente"
                        value="{{ $ambiente->tipo_ambiente->tip_Denominacion ?? 'Sin definir' }}"
                        disabled>

                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        </x-slot>

                    </x-adminlte-input>

                </div>

                <div class="col-md-4">

                    <x-adminlte-input
                        name="estado"
                        label="Estado"
                        value="{{ $ambiente->estado_ambiente->est_Denominacion ?? 'Desconocido' }}"
                        disabled>

                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-info-circle"></i>
                            </div>
                        </x-slot>

                    </x-adminlte-input>

                </div>

            </div>

            <hr>

            <div class="mt-3">

                <a href="{{ route('ambientes.edit', $ambiente) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                    Editar
                </a>

                <form action="{{ route('ambientes.destroy', $ambiente) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                        onclick="return confirm('¿Está seguro de eliminar este ambiente?')">

                        <i class="fas fa-trash"></i>
                        Eliminar

                    </button>

                </form>

            </div>

        </div>

    </div>

@stop
