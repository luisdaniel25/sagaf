@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="mb-4">Crear Evento</h1>

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('eventos.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">Título</label>

                <input
                    type="text"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}"
                    required>

                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Descripción</label>

                <textarea
                    name="descripcion"
                    class="form-control @error('descripcion') is-invalid @enderror"
                    rows="4">{{ old('descripcion') }}</textarea>

                @error('descripcion')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Color</label>

                <input
                    type="color"
                    name="color"
                    class="form-control form-control-color"
                    value="{{ old('color', '#3788d8') }}">

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">Fecha inicio</label>

                        <input
                            type="date"
                            name="start"
                            class="form-control"
                            value="{{ old('start') }}"
                            required>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">Hora inicio</label>

                        <input
                            type="time"
                            name="horaInicio"
                            class="form-control"
                            value="{{ old('horaInicio') }}"
                            required>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">Fecha fin</label>

                        <input
                            type="date"
                            name="end"
                            class="form-control"
                            value="{{ old('end') }}"
                            required>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">Hora fin</label>

                        <input
                            type="time"
                            name="horaFinal"
                            class="form-control"
                            value="{{ old('horaFinal') }}"
                            required>

                    </div>

                </div>

            </div>

            <div class="mt-4">

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Crear Evento
                </button>

                <a href="{{ route('eventos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Cancelar
                </a>

            </div>

        </form>

    </div>

@endsection
