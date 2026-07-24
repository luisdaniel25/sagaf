@extends('adminlte::page')

@section('title', 'Nueva Asignación')

@section('content_header')
    <h1>Crear Asignación de Instructor</h1>
@stop

@section('content')

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">
                Registrar Nueva Asignación
            </h3>

        </div>

        <form action="{{ route('asignaciones.store') }}" method="POST" id="form-asignacion">

            @csrf

            <div class="card-body">

                @if($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show">

                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert">

                            &times;

                        </button>

                        <h5>

                            <i class="fas fa-exclamation-triangle"></i>

                            Se encontraron errores

                        </h5>

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <div class="row">

                    {{-- =========================
                         INSTRUCTOR
                    ========================== --}}

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Instructor
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="Codigo_instructor"
                                class="form-control select2 @error('Codigo_instructor') is-invalid @enderror"
                                required>

                                <option value="">
                                    Seleccione un instructor
                                </option>

                                @foreach($instructores as $inst)

                                    <option
                                        value="{{ $inst->Codigo }}"
                                        @selected(old('Codigo_instructor') == $inst->Codigo)>

                                        {{ $inst->inst_Nombres }}
                                        {{ $inst->inst_Apellido }}

                                        ({{ $inst->inst_Identificacion ?: 'Sin identificación' }})

                                    </option>

                                @endforeach

                            </select>

                            @error('Codigo_instructor')

                            <span class="invalid-feedback">

                                {{ $message }}

                            </span>

                            @enderror

                        </div>

                    </div>

                    {{-- =========================
                         FICHA
                    ========================== --}}

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Ficha
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="Codigo_ficha"
                                class="form-control select2 @error('Codigo_ficha') is-invalid @enderror"
                                required>

                                <option value="">
                                    Seleccione una ficha
                                </option>

                                @foreach($fichas as $ficha)

                                    <option
                                        value="{{ $ficha->Codigo }}"
                                        @selected(old('Codigo_ficha') == $ficha->Codigo)>

                                        Ficha #{{ $ficha->Codigo }}

                                        -

                                        {{ optional($ficha->programa)->prog_Nombre ?? 'Sin programa' }}

                                    </option>

                                @endforeach

                            </select>

                            @error('Codigo_ficha')

                            <span class="invalid-feedback">

                                {{ $message }}

                            </span>

                            @enderror

                        </div>

                    </div>

                </div>

                <div class="row">

                    {{-- =========================
                         COMPETENCIA
                    ========================== --}}

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Competencia
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="Codigo_competencia"
                                class="form-control select2 @error('Codigo_competencia') is-invalid @enderror"
                                required>

                                <option value="">
                                    Seleccione una competencia
                                </option>

                                @foreach($competencias as $comp)

                                    <option
                                        value="{{ $comp->comp_codigoCompetencia }}"
                                        @selected(old('Codigo_competencia') == $comp->comp_codigoCompetencia)>

                                        {{ $comp->comp_Denominacion }}

                                        ({{ $comp->comp_Horas_FI }} horas)

                                    </option>

                                @endforeach

                            </select>

                            @error('Codigo_competencia')

                            <span class="invalid-feedback">

                                {{ $message }}

                            </span>

                            @enderror

                        </div>

                    </div>

                    {{-- =========================
                         AMBIENTE
                    ========================== --}}

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Ambiente

                            </label>

                            <select
                                name="Codigo_ambiente"
                                class="form-control select2">

                                <option value="">
                                    Sin ambiente (Virtual)
                                </option>

                                @foreach($ambientes as $amb)

                                    <option
                                        value="{{ $amb->Codigo }}"
                                        @selected(old('Codigo_ambiente') == $amb->Codigo)>

                                        {{ $amb->amb_Denominacion }}

                                        -

                                        Cupo:
                                        {{ $amb->amb_Cupo }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

                <div class="row">

                    {{-- =========================
                         FECHA
                    ========================== --}}

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Fecha de Asignación
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="date"
                                name="FechaAsignacion"
                                class="form-control @error('FechaAsignacion') is-invalid @enderror"
                                value="{{ old('FechaAsignacion', now()->format('Y-m-d')) }}"
                                max="{{ now()->format('Y-m-d') }}"
                                required>

                            @error('FechaAsignacion')

                            <span class="invalid-feedback">

                                {{ $message }}

                            </span>

                            @enderror

                        </div>

                    </div>

                    {{-- =========================
                         ESTADO
                    ========================== --}}

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Estado
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="Estado"
                                class="form-control"
                                required>

                                <option value="Asignado">
                                    Asignado
                                </option>

                                <option value="En curso">
                                    En curso
                                </option>

                                <option value="Finalizado">
                                    Finalizado
                                </option>

                                <option value="Cancelado">
                                    Cancelado
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- =========================
                     OBSERVACIONES
                ========================== --}}

                <div class="form-group">

                    <label>

                        Observaciones

                    </label>

                    <textarea
                        name="Observaciones"
                        rows="4"
                        class="form-control"
                        placeholder="Ingrese observaciones...">{{ old('Observaciones') }}</textarea>

                </div>

            </div>

            <div class="card-footer text-right">

                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Guardar Asignación

                </button>

                <a
                    href="{{ route('asignaciones.index') }}"
                    class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Cancelar

                </a>

            </div>

        </form>

    </div>

@stop

@section('css')

    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css"
        rel="stylesheet">

@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        $(function () {

            $('.select2').select2({

                theme: 'bootstrap4',

                width: '100%',

                placeholder: 'Seleccione una opción',

                allowClear: true

            });

        });

    </script>

@stop
