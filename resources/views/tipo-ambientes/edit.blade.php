@extends('adminlte::page')

@section('title', 'Editar Tipo de Ambiente')

@section('content_header')
    <h1>Editar Tipo: {{ $tipo->tip_Denominacion }}</h1>
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
            <form action="{{ route('tipo-ambientes.update', $tipo->Codigo) }}" method="POST">
                @csrf
                @method('PUT')

                <x-adminlte-input
                    name="tip_Denominacion"
                    label="Denominación *"
                    value="{{ old('tip_Denominacion', $tipo->tip_Denominacion) }}"
                    required
                />

                <div class="mt-4">
                    <x-adminlte-button
                        class="btn-primary"
                        type="submit"
                        label="Actualizar"
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
