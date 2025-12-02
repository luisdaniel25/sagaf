@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Evento</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('eventos.update', $evento->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $evento->title) }}">
            </div>
            <div class="mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control">{{ old('descripcion', $evento->descripcion) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Color</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $evento->color) }}">
            </div>
            <div class="mb-3">
                <label>Fecha inicio</label>
                <input type="date" name="start" class="form-control" value="{{ old('start', $evento->start) }}">
            </div>
            <div class="mb-3">
                <label>Hora inicio</label>
                <input type="time" name="horaInicio" class="form-control" value="{{ old('horaInicio', $evento->horaInicio) }}">
            </div>
            <div class="mb-3">
                <label>Fecha fin</label>
                <input type="date" name="end" class="form-control" value="{{ old('end', $evento->end) }}">
            </div>
            <div class="mb-3">
                <label>Hora fin</label>
                <input type="time" name="horaFinal" class="form-control" value="{{ old('horaFinal', $evento->horaFinal) }}">
            </div>
            <button class="btn btn-success">Actualizar Evento</button>
            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
