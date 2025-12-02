@extends('adminlte::page')

@section('title', 'Editar Programa de Formación')

@section('content_header')
    <h1>Editar Programa: {{ $programa->prog_Denominacion }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('programas.update', $programa->prog_codigoPrograma) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prog_Denominacion">Denominación *</label>
                            <input type="text" name="prog_Denominacion" id="prog_Denominacion"
                                   class="form-control @error('prog_Denominacion') is-invalid @enderror"
                                   value="{{ old('prog_Denominacion', $programa->prog_Denominacion) }}" required>
                            @error('prog_Denominacion')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prog_version">Versión *</label>
                            <input type="number" name="prog_version" id="prog_version"
                                   class="form-control @error('prog_version') is-invalid @enderror"
                                   value="{{ old('prog_version', $programa->prog_version) }}" required>
                            @error('prog_version')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prog_Estado">Estado</label>
                            <select name="prog_Estado" id="prog_Estado" class="form-control">
                                <option value="">Seleccionar Estado</option>
                                <option value="Activo" {{ old('prog_Estado', $programa->prog_Estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('prog_Estado', $programa->prog_Estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                <option value="En revisión" {{ old('prog_Estado', $programa->prog_Estado) == 'En revisión' ? 'selected' : '' }}>En revisión</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prog_NivelFormacion">Nivel de Formación</label>
                            <input type="text" name="prog_NivelFormacion" id="prog_NivelFormacion"
                                   class="form-control" value="{{ old('prog_NivelFormacion', $programa->prog_NivelFormacion) }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prog_HorasEstimadas">Horas Estimadas *</label>
                            <input type="text" name="prog_HorasEstimadas" id="prog_HorasEstimadas"
                                   class="form-control @error('prog_HorasEstimadas') is-invalid @enderror"
                                   value="{{ old('prog_HorasEstimadas', $programa->prog_HorasEstimadas) }}" required>
                            @error('prog_HorasEstimadas')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prog_Creditos">Créditos *</label>
                            <input type="text" name="prog_Creditos" id="prog_Creditos"
                                   class="form-control @error('prog_Creditos') is-invalid @enderror"
                                   value="{{ old('prog_Creditos', $programa->prog_Creditos) }}" required>
                            @error('prog_Creditos')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prog_DuracionMeses">Duración (Meses) *</label>
                            <input type="text" name="prog_DuracionMeses" id="prog_DuracionMeses"
                                   class="form-control @error('prog_DuracionMeses') is-invalid @enderror"
                                   value="{{ old('prog_DuracionMeses', $programa->prog_DuracionMeses) }}" required>
                            @error('prog_DuracionMeses')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prog_etapaLectiva">Etapa Lectiva (Horas) *</label>
                            <input type="number" name="prog_etapaLectiva" id="prog_etapaLectiva"
                                   class="form-control @error('prog_etapaLectiva') is-invalid @enderror"
                                   value="{{ old('prog_etapaLectiva', $programa->prog_etapaLectiva) }}" required>
                            @error('prog_etapaLectiva')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prog_etapaProductiva">Etapa Productiva (Horas) *</label>
                            <input type="number" name="prog_etapaProductiva" id="prog_etapaProductiva"
                                   class="form-control @error('prog_etapaProductiva') is-invalid @enderror"
                                   value="{{ old('prog_etapaProductiva', $programa->prog_etapaProductiva) }}" required>
                            @error('prog_etapaProductiva')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prog_totalHoras">Total Horas *</label>
                            <input type="number" name="prog_totalHoras" id="prog_totalHoras"
                                   class="form-control @error('prog_totalHoras') is-invalid @enderror"
                                   value="{{ old('prog_totalHoras', $programa->prog_totalHoras) }}" required>
                            @error('prog_totalHoras')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prog_Descripcion">Descripción *</label>
                    <textarea name="prog_Descripcion" id="prog_Descripcion"
                              class="form-control @error('prog_Descripcion') is-invalid @enderror"
                              rows="3" required>{{ old('prog_Descripcion', $programa->prog_Descripcion) }}</textarea>
                    @error('prog_Descripcion')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="prog_justificacion">Justificación *</label>
                    <textarea name="prog_justificacion" id="prog_justificacion"
                              class="form-control @error('prog_justificacion') is-invalid @enderror"
                              rows="3" required>{{ old('prog_justificacion', $programa->prog_justificacion) }}</textarea>
                    @error('prog_justificacion')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="prog_metodologia">Metodología *</label>
                    <textarea name="prog_metodologia" id="prog_metodologia"
                              class="form-control @error('prog_metodologia') is-invalid @enderror"
                              rows="3" required>{{ old('prog_metodologia', $programa->prog_metodologia) }}</textarea>
                    @error('prog_metodologia')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Actualizar Programa
                    </button>
                    <a href="{{ route('programas.show', $programa->prog_codigoPrograma) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
