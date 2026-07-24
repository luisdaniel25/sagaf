@extends('adminlte::page')

@section('title', 'Crear Ambiente')

@section('content_header')
    <h1>Registrar Ambiente</h1>
@stop

@section('content')

    @if(session('success'))
        <x-adminlte-alert
            theme="success"
            title="Éxito"
            dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    @if($errors->any())
        <x-adminlte-alert
            theme="danger"
            title="Errores en el formulario"
            dismissable>

            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </x-adminlte-alert>
    @endif

    <div class="card shadow-sm">

        <div class="card-header">
            <h3 class="card-title">
                Información del Ambiente
            </h3>
        </div>

        <div class="card-body">

            <form action="{{ route('ambientes.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6">

                        <x-adminlte-input
                            name="amb_Denominacion"
                            label="Denominación"
                            value="{{ old('amb_Denominacion') }}"
                            required>

                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-primary">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                            </x-slot>

                        </x-adminlte-input>

                        <x-adminlte-input
                            name="amb_Cupo"
                            type="number"
                            min="1"
                            label="Cupo"
                            value="{{ old('amb_Cupo') }}"
                            required>

                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-info">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                            </x-slot>

                        </x-adminlte-input>

                    </div>

                    <div class="col-md-6">

                        <x-adminlte-select
                            name="Codigo_tipo"
                            label="Tipo de Ambiente"
                            required>

                            <option value="">
                                Seleccione...
                            </option>

                            @foreach ($tipos as $tipo)

                                <option
                                    value="{{ $tipo->Codigo }}"
                                    @selected(old('Codigo_tipo') == $tipo->Codigo)>

                                    {{ $tipo->tip_Denominacion }}

                                </option>

                            @endforeach

                        </x-adminlte-select>

                        <x-adminlte-select
                            name="Codigo_estado"
                            label="Estado"
                            required>

                            <option value="">
                                Seleccione...
                            </option>

                            @foreach ($estados as $estado)

                                <option
                                    value="{{ $estado->Codigo }}"
                                    @selected(old('Codigo_estado') == $estado->Codigo)>

                                    {{ $estado->est_Denominacion }}

                                </option>

                            @endforeach

                        </x-adminlte-select>

                    </div>

                </div>

                <div class="mt-3">

                    <x-adminlte-button
                        type="submit"
                        label="Guardar"
                        theme="primary"
                        icon="fas fa-save"/>

                    <a href="{{ route('ambientes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>

                </div>

            </form>

        </div>

    </div>

@stop
