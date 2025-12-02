@extends('adminlte::page')

@section('title', 'Crear Solicitud')

@section('content_header')
    <h1>Crear Nueva Solicitud de Programación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('solicitudes.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="ficha_id">Ficha</label>
                    <select name="ficha_id" id="ficha_id" class="form-control @error('ficha_id') is-invalid @enderror" required>
                        <option value="">Seleccione una ficha</option>
                        @foreach($fichas as $ficha)
                            <option value="{{ $ficha->id }}" {{ old('ficha_id') == $ficha->id ? 'selected' : '' }}>
                                {{ $ficha->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('ficha_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="competencia_id">Competencia</label>
                    <select name="competencia_id" id="competencia_id" class="form-control @error('competencia_id') is-invalid @enderror" required>
                        <option value="">Seleccione una competencia</option>
                        @foreach($competencias as $competencia)
                            <option value="{{ $competencia->id }}" {{ old('competencia_id') == $competencia->id ? 'selected' : '' }}>
                                {{ $competencia->comp_Denominacion }}
                            </option>
                        @endforeach
                    </select>
                    @error('competencia_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-2">Guardar Solicitud</button>
                <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
            </form>
        </div>
    </div>
@stop
