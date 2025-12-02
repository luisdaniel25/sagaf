@extends('adminlte::page')

@section('title', 'Editar Ambiente')

@section('content_header')
    <h1>Editar Ambiente</h1>
@stop

@section('content')

    {{-- MENSAJE DE ÉXITO --}}
    @if (session('success'))
        <x-adminlte-alert theme="success" title="Éxito">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    {{-- ERRORES DE VALIDACIÓN --}}
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

            <form action="{{ route('ambientes.update', $ambiente->Codigo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- COLUMNA IZQUIERDA --}}
                    <div class="col-md-6">

                        <x-adminlte-input
                            name="amb_Denominacion"
                            label="Denominación"
                            value="{{ old('amb_Denominacion', $ambiente->amb_Denominacion) }}"
                            required
                        />

                        <x-adminlte-input
                            name="amb_Cupo"
                            type="number"
                            label="Cupo"
                            value="{{ old('amb_Cupo', $ambiente->amb_Cupo) }}"
                            required
                        />

                    </div>

                    {{-- COLUMNA DERECHA --}}
                    <div class="col-md-6">

                        {{-- SELECT TIPO --}}
                        <x-adminlte-select name="Codigo_tipo" label="Tipo de ambiente" required>
                            <option value="">Seleccione...</option>

                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->Codigo }}"
                                    {{ old('Codigo_tipo', $ambiente->Codigo_tipo) == $tipo->Codigo ? 'selected' : '' }}>
                                    {{ $tipo->tip_Denominacion }}
                                </option>
                            @endforeach
                        </x-adminlte-select>

                        {{-- SELECT ESTADO --}}
                        <x-adminlte-select name="Codigo_estado" label="Estado" required>
                            <option value="">Seleccione...</option>

                            @foreach ($estados as $estado)
                                <option value="{{ $estado->Codigo }}"
                                    {{ old('Codigo_estado', $ambiente->Codigo_estado) == $estado->Codigo ? 'selected' : '' }}>
                                    {{ $estado->est_Denominacion }}
                                </option>
                            @endforeach
                        </x-adminlte-select>

                    </div>

                </div>

                <x-adminlte-button
                    class="btn-primary"
                    type="submit"
                    label="Actualizar"
                    icon="fas fa-save"
                />

            </form>
        </div>
    </div>
@stop
