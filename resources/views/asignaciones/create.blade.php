@extends('adminlte::page')

@section('title', 'Nueva Asignación')
@section('pageHeader', 'Crear Asignación de Instructor')

@section('content')
    <div class="card">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>¡Error!</strong> Por favor corrige los siguientes errores:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('asignaciones.store') }}" method="POST" id="form-asignacion">
                @csrf

                {{-- =============================
                     INSTRUCTOR
                ============================== --}}
                <div class="form-group">
                    <label>Instructor <span class="text-danger">*</span></label>
                    <select name="Codigo_instructor" class="form-control select2 @error('Codigo_instructor') is-invalid @enderror" required>
                        <option value="">Seleccione un instructor</option>
                        @foreach($instructores as $inst)
                            <option value="{{ $inst->Codigo }}"
                                {{ old('Codigo_instructor') == $inst->Codigo ? 'selected' : '' }}>
                                {{ $inst->inst_Nombres }}
                                {{ $inst->inst_Apellido }}
                                ({{ $inst->inst_Identificacion ?: 'Sin identificación' }})
                            </option>
                        @endforeach
                    </select>
                    @error('Codigo_instructor')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- =============================
                     FICHA
                ============================== --}}
                <div class="form-group">
                    <label>Ficha <span class="text-danger">*</span></label>
                    <select name="Codigo_ficha" class="form-control select2 @error('Codigo_ficha') is-invalid @enderror" required>
                        <option value="">Seleccione una ficha</option>
                        @foreach($fichas as $ficha)
                            @php
                                // Usar el ID como identificador si no hay número de ficha
                                $identificador = $ficha->Codigo;
                                $programaNombre = optional($ficha->programa)->prog_Nombre ?? 'Sin programa';
                            @endphp
                            <option value="{{ $ficha->Codigo }}"
                                {{ old('Codigo_ficha') == $ficha->Codigo ? 'selected' : '' }}>
                                Ficha #{{ $ficha->Codigo }}
                                —
                                {{ $programaNombre }}
                                ({{ $ficha->fich_Inicio ?? 'Sin fecha' }} a {{ $ficha->fich_Fin ?? 'Sin fecha' }})
                            </option>
                        @endforeach
                    </select>
                    @error('Codigo_ficha')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Se muestran las fichas activas con sus programas asociados
                    </small>
                </div>

                {{-- =============================
                     COMPETENCIA
                ============================== --}}
                <div class="form-group">
                    <label>Competencia <span class="text-danger">*</span></label>
                    <select name="Codigo_competencia" class="form-control select2 @error('Codigo_competencia') is-invalid @enderror" required>
                        <option value="">Seleccione una competencia</option>
                        @foreach($competencias as $comp)
                            @php
                                // IMPORTANTE: Usar comp_codigoCompetencia como valor
                                $id = $comp->comp_codigoCompetencia;
                                $nombre = $comp->comp_Denominacion ?? 'Sin nombre';
                                $horas = $comp->comp_Horas_FI ?? 0;
                                $creditos = $comp->comp_Creditos ?? 0;
                            @endphp
                            <option value="{{ $id }}"
                                {{ old('Codigo_competencia') == $id ? 'selected' : '' }}>
                                {{ $nombre }}
                                ({{ $horas }} horas, {{ $creditos }} créditos)
                            </option>
                        @endforeach
                    </select>
                    @error('Codigo_competencia')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- =============================
                     AMBIENTE
                ============================== --}}
                <div class="form-group">
                    <label>Ambiente</label>
                    <select name="Codigo_ambiente" class="form-control select2 @error('Codigo_ambiente') is-invalid @enderror">
                        <option value="">Sin ambiente (virtual)</option>
                        @foreach($ambientes as $amb)
                            @php
                                $estado = optional($amb->estado_ambiente)->est_Denominacion ?? 'N/A';
                                $tipo = optional($amb->tipo_ambiente)->tip_Denominacion ?? 'N/A';
                                $cupo = $amb->amb_Cupo ?? 0;
                            @endphp
                            <option value="{{ $amb->Codigo }}"
                                {{ old('Codigo_ambiente') == $amb->Codigo ? 'selected' : '' }}>
                                {{ $amb->amb_Denominacion ?? 'Ambiente sin nombre' }}
                                ({{ $tipo }} - Cupo: {{ $cupo }} - {{ $estado }})
                            </option>
                        @endforeach
                    </select>
                    @error('Codigo_ambiente')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- =============================
                     FECHA ASIGNACIÓN
                ============================== --}}
                <div class="form-group">
                    <label>Fecha Asignación <span class="text-danger">*</span></label>
                    <input type="date" name="FechaAsignacion"
                           class="form-control @error('FechaAsignacion') is-invalid @enderror"
                           value="{{ old('FechaAsignacion', date('Y-m-d')) }}"
                           max="{{ date('Y-m-d') }}"
                           required>
                    @error('FechaAsignacion')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- =============================
                     ESTADO
                ============================== --}}
                <div class="form-group">
                    <label>Estado <span class="text-danger">*</span></label>
                    <select name="Estado" class="form-control @error('Estado') is-invalid @enderror" required>
                        <option value="Asignado" {{ old('Estado') == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                        <option value="En curso" {{ old('Estado') == 'En curso' ? 'selected' : '' }}>En curso</option>
                        <option value="Finalizado" {{ old('Estado') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        <option value="Cancelado" {{ old('Estado') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    @error('Estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- =============================
                     OBSERVACIONES
                ============================== --}}
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea name="Observaciones" class="form-control @error('Observaciones') is-invalid @enderror" rows="3"
                              placeholder="Ingrese observaciones adicionales si es necesario">{{ old('Observaciones') }}</textarea>
                    @error('Observaciones')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Asignación
                    </button>

                    <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
