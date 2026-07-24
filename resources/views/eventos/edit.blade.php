@extends('adminlte::page')

@section('title', 'Editar Evento')

@section('content_header')
    <h1>Editar Evento</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header bg-primary">
            <h3 class="card-title">Actualizar Información del Evento</h3>
        </div>

        <form action="{{ route('eventos.update', $evento->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="card-body">

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Título</label>

                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $evento->title) }}"
                                required>

                            @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Color</label>

                            <input
                                type="color"
                                name="color"
                                class="form-control"
                                value="{{ old('color', $evento->color ?? '#3788d8') }}">

                        </div>

                    </div>

                </div>

                <div class="form-group">

                    <label>Descripción</label>

                    <textarea
                        name="descripcion"
                        rows="4"
                        class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $evento->descripcion) }}</textarea>

                    @error('descripcion')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Fecha Inicio</label>

                            <input
                                type="date"
                                name="start"
                                class="form-control"
                                value="{{ old('start', optional($evento->start)->format('Y-m-d')) }}"
                                required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Hora Inicio</label>

                            <input
                                type="time"
                                name="horaInicio"
                                class="form-control"
                                value="{{ old('horaInicio', $evento->horaInicio) }}"
                                required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Fecha Fin</label>

                            <input
                                type="date"
                                name="end"
                                class="form-control"
                                value="{{ old('end', optional($evento->end)->format('Y-m-d')) }}"
                                required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Hora Fin</label>

                            <input
                                type="time"
                                name="horaFinal"
                                class="form-control"
                                value="{{ old('horaFinal', $evento->horaFinal) }}"
                                required>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Actualizar Evento
                </button>

                <a href="{{ route('eventos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Cancelar
                </a>

            </div>

        </form>

    </div>

@stop
