@extends('adminlte::page')

@section('title', 'Crear Ficha')

@section('content_header')
    <h1>Crear Nueva Ficha de Caracterización</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="card-title">Información de la Ficha</h3>
                </div>

                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Por favor corrige los siguientes errores:</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('fichas.store') }}" method="POST" id="fichaForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Codigo" class="font-weight-bold">Código de Ficha *</label>
                                    <input type="text"
                                           name="Codigo"
                                           id="Codigo"
                                           class="form-control @error('Codigo') is-invalid @enderror"
                                           value="{{ old('Codigo') }}"
                                           required
                                           placeholder="Ingrese el código numérico">
                                    @error('Codigo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fich_Etapa" class="font-weight-bold">Etapa *</label>
                                    <select name="fich_Etapa"
                                            id="fich_Etapa"
                                            class="form-control @error('fich_Etapa') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione una etapa...</option>
                                        <option value="Lectiva" {{ old('fich_Etapa') == 'Lectiva' ? 'selected' : '' }}>Lectiva</option>
                                        <option value="Productiva" {{ old('fich_Etapa') == 'Productiva' ? 'selected' : '' }}>Productiva</option>
                                    </select>
                                    @error('fich_Etapa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fich_Inicio" class="font-weight-bold">Fecha Inicio *</label>
                                    <input type="date"
                                           name="fich_Inicio"
                                           id="fich_Inicio"
                                           class="form-control @error('fich_Inicio') is-invalid @enderror"
                                           value="{{ old('fich_Inicio') }}"
                                           required>
                                    @error('fich_Inicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fich_Fin" class="font-weight-bold">Fecha Fin *</label>
                                    <input type="date"
                                           name="fich_Fin"
                                           id="fich_Fin"
                                           class="form-control @error('fich_Fin') is-invalid @enderror"
                                           value="{{ old('fich_Fin') }}"
                                           required>
                                    @error('fich_Fin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Codigo_modalidad" class="font-weight-bold">Modalidad *</label>
                                    <select name="Codigo_modalidad"
                                            id="Codigo_modalidad"
                                            class="form-control @error('Codigo_modalidad') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione una modalidad...</option>
                                        @foreach($modalidades as $modalidad)
                                            <option value="{{ $modalidad->id }}" {{ old('Codigo_modalidad') == $modalidad->id ? 'selected' : '' }}>
                                                {{ $modalidad->mod_Denominacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Codigo_modalidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Codigo_centro" class="font-weight-bold">Centro de Formación *</label>
                                    <select name="Codigo_centro"
                                            id="Codigo_centro"
                                            class="form-control @error('Codigo_centro') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione un centro...</option>
                                        @foreach($centros as $centro)
                                            <option value="{{ $centro->Codigo }}" {{ old('Codigo_centro') == $centro->Codigo ? 'selected' : '' }}>
                                                {{ $centro->cent_Denominacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Codigo_centro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Codigo_programa" class="font-weight-bold">Programa de Formación *</label>
                                    <select name="Codigo_programa"
                                            id="Codigo_programa"
                                            class="form-control @error('Codigo_programa') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione un programa...</option>
                                        @foreach($programas as $programa)
                                            <option value="{{ $programa->prog_codigoPrograma }}" {{ old('Codigo_programa') == $programa->prog_codigoPrograma ? 'selected' : '' }}>
                                                {{ $programa->prog_Denominacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Codigo_programa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="confirmData" required>
                                <label class="custom-control-label text-danger" for="confirmData">
                                    Confirmo que la información ingresada es correcta
                                </label>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('fichas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver al Listado
                            </a>

                            <button type="submit" class="btn btn-success" id="btnSubmit">
                                <i class="fas fa-save"></i> Guardar Ficha
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Validación de fechas
            $('#fichaForm').on('submit', function(e) {
                const inicio = new Date($('#fich_Inicio').val());
                const fin = new Date($('#fich_Fin').val());

                if (fin <= inicio) {
                    e.preventDefault();
                    alert('La fecha fin debe ser posterior a la fecha inicio');
                    $('#fich_Fin').focus();
                }
            });

            // Auto-dismiss alerts
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
@stop
