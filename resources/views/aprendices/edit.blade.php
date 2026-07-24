@extends('adminlte::page')

@section('title', 'Editar Aprendiz')

@section('content_header')
    <h1>Editar Aprendiz</h1>
@stop

@section('content')

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Por favor corrige los siguientes errores:
            </strong>

            <ul class="mb-0">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <div class="card">

        <div class="card-header bg-primary">

            <h3 class="card-title">
                Información del Aprendiz
            </h3>

        </div>

        <div class="card-body">

            {{ route('aprendices.update', $aprendiz) }}POST">

            @csrf
            @method('PUT')

            {{-- AQUÍ VAN TODOS TUS CAMPOS --}}

            <div class="form-group">

                <label>
                    Primer Nombre *
                </label>

                <input
                    type="text"
                    name="apr_PrimerNombre"
                    class="form-control @error('apr_PrimerNombre') is-invalid @enderror"
                    value="{{ old('apr_PrimerNombre', $aprendiz->apr_PrimerNombre) }}"
                    required>

                @error('apr_PrimerNombre')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- RESTO DEL FORMULARIO... --}}

            <div class="mt-4">

                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="fas fa-save"></i>
                    Actualizar

                </button>

                {{ route('aprendices.index') }}-secondary">

                <i class="fas fa-arrow-left"></i>
                Cancelar

                </a>

            </div>

            </form>

        </div>

    </div>

@stop
