@extends('adminlte::page')

@section('title', 'Crear Tipo de Ambiente')

@section('content_header')
    <h1>Crear Tipo de Ambiente</h1>
@stop

@section('content')

    @if ($errors->any())
        <x-adminlte-alert theme="danger" title="Errores en el formulario">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tipo-ambientes.store') }}" method="POST">
                @csrf

                <x-adminlte-input
                    name="tip_Denominacion"
                    label="Denominación *"
                    placeholder="Ej: Aula, Laboratorio, Taller..."
                    value="{{ old('tip_Denominacion') }}"
                    required
                />

                <div class="mt-4">
                    <x-adminlte-button
                        class="btn-primary"
                        type="submit"
                        label="Guardar"
                        icon="fas fa-save"
                    />
                    <a href="{{ route('tipo-ambientes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop
