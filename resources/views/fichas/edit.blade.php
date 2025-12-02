@extends('adminlte::page')

@section('title', 'Editar Ficha')

@section('content_header')
    <h1>Editar Ficha: {{ $ficha->Codigo }}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title">Editar Información de la Ficha</h3>
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

                    <form action="{{ route('fichas.update', $ficha->Codigo) }}" method="POST" id="fichaForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Código de Ficha</label>
                                    <input type="text" class="form-control bg-light" value="{{ $ficha->Codigo }}" disabled>
                                    <small class="form-text text-muted">El código de ficha no puede ser modificado</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fich_Etapa" class="font-weight-bold">Etapa *</label>
                                    <select name="fich_Etapa"
                                            id="fich_Etapa"
                                            class="form-control @error('fich_Etapa') is-invalid @enderror"
                                            required>
                                        <option value="Lectiva" {{ $ficha->fich_Etapa == 'Lectiva' ? 'selected' : '' }}>Lectiva</option>
                                        <option value="Productiva" {{ $ficha->fich_Etapa == 'Productiva' ? 'selected' : '' }}>Productiva</option>
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
                                           value="{{ $ficha->fich_Inicio->format('Y-m-d') }}"
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
                                           value="{{ $ficha->fich_Fin->format('Y-m-d') }}"
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
                                        @foreach($modalidades as $modalidad)
                                            <option value="{{ $modalidad->id }}"
                                                {{ $modalidad->id == $ficha->Codigo_modalidad ? 'selected' : '' }}>
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
                                        @foreach($centros as $centro)
                                            <option value="{{ $centro->Codigo }}"
                                                {{ $centro->Codigo == $ficha->Codigo_centro ? 'selected' : '' }}>
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
                                        @foreach($programas as $programa)
                                            <option value="{{ $programa->prog_codigoPrograma }}"
                                                {{ $programa->prog_codigoPrograma == $ficha->Codigo_programa ? 'selected' : '' }}>
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

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('fichas.show', $ficha->Codigo) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> Ver Detalle
                            </a>

                            <div class="btn-group">
                                <a href="{{ route('fichas.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Cancelar
                                </a>

                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Actualizar Ficha
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@stop
