@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Evento</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('eventos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
            </div>
            <div class="mb-3">
                <label>Color</label>
                <input type="text" name="color" class="form-control" value="{{ old('color') }}">
            </div>
            <div class="mb-3">
                <label>Fecha inicio</label>
                <input type="date" name="start" class="form-control" value="{{ old('start') }}">
            </div>
            <div class="mb-3">
                <label>Hora inicio</label>
                <input type="time" name="horaInicio" class="form-control" value="{{ old('horaInicio') }}">
            </div>
            <div class="mb-3">
                <label>Fecha fin</label>
                <input type="date" name="end" class="form-control" value="{{ old('end') }}">
            </div>
            <div class="mb-3">
                <label>Hora fin</label>
                <input type="time" name="horaFinal" class="form-control" value="{{ old('horaFinal') }}">
            </div>
            <button class="btn btn-success">Crear Evento</button>
            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
