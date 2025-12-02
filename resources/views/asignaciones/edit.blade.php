@extends('adminlte::page')

@section('title', 'Editar Asignación')

@section('content_header')
    <h1>Editar Asignación #{{ $asignacion->Codigo }}</h1>
@stop

@section('content')

    @if ($errors->any())
        <x-adminlte-alert theme="danger" title="Errores en el formulario">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('asignaciones.update', $asignacion->Codigo) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- ================================
                     FILA 1: INSTRUCTOR / FICHA
                ================================== --}}
                <div class="row">
                    <div class="col-md-6">
                        <x-adminlte-select name="Codigo_instructor" label="Instructor *" required>
                            <option value="">Seleccione un instructor</option>
                            @foreach($instructores as $inst)
                                @php
                                    $nombre = ($inst->inst_Nombres ?? '') . ' ' . ($inst->inst_Apellido ?? '');
                                    $identificacion = $inst->inst_Identificacion ?? 'N/A';
                                @endphp
                                <option value="{{ $inst->Codigo }}"
                                    {{ old('Codigo_instructor', $asignacion->Codigo_instructor) == $inst->Codigo ? 'selected' : '' }}>
                                    {{ trim($nombre) }} ({{ $identificacion }})
                                </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-select name="Codigo_ficha" label="Ficha *" required>
                            <option value="">Seleccione una ficha</option>
                            @foreach($fichas as $ficha)
                                @php
                                    // CORRECCIÓN: No existe Fic_Numero, usar Codigo
                                    $identificador = $ficha->Codigo;
                                    $programaNombre = optional($ficha->programa)->prog_Nombre ?? 'Sin programa';
                                    $fechaInicio = $ficha->fich_Inicio ?? 'Sin fecha';
                                @endphp
                                <option value="{{ $ficha->Codigo }}"
                                    {{ old('Codigo_ficha', $asignacion->Codigo_ficha) == $ficha->Codigo ? 'selected' : '' }}>
                                    Ficha #{{ $identificador }} — {{ $programaNombre }}
                                    (Inicio: {{ $fechaInicio }})
                                </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>
                </div>

                {{-- ================================
                     FILA 2: COMPETENCIA / AMBIENTE
                ================================== --}}
                <div class="row">
                    <div class="col-md-6">
                        <x-adminlte-select name="Codigo_competencia" label="Competencia *" required>
                            <option value="">Seleccione una competencia</option>
                            @foreach($competencias as $comp)
                                @php
                                    // CORRECCIÓN CRÍTICA: Usar comp_codigoCompetencia como valor
                                    $idComp = $comp->comp_codigoCompetencia;
                                    $nombreComp = $comp->comp_Denominacion ?? 'Sin nombre';
                                    $horas = $comp->comp_Horas_FI ?? 0;
                                @endphp
                                <option value="{{ $idComp }}"
                                    {{ old('Codigo_competencia', $asignacion->Codigo_competencia) == $idComp ? 'selected' : '' }}>
                                    {{ $nombreComp }} ({{ $horas }} horas)
                                </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-select name="Codigo_ambiente" label="Ambiente">
                            <option value="">Sin ambiente (virtual)</option>
                            @foreach($ambientes as $amb)
                                @php
                                    $tipo = optional($amb->tipo_ambiente)->tip_Denominacion ?? 'N/A';
                                    $cupo = $amb->amb_Cupo ?? 0;
                                    $estado = optional($amb->estado_ambiente)->est_Denominacion ?? 'N/A';
                                @endphp
                                <option value="{{ $amb->Codigo }}"
                                    {{ old('Codigo_ambiente', $asignacion->Codigo_ambiente) == $amb->Codigo ? 'selected' : '' }}>
                                    {{ $amb->amb_Denominacion ?? 'Ambiente sin nombre' }}
                                    ({{ $tipo }} - Cupo: {{ $cupo }} - {{ $estado }})
                                </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>
                </div>

                {{-- ================================
                     FILA 3: FECHA / ESTADO
                ================================== --}}
                <div class="row">
                    <div class="col-md-6">
                        <x-adminlte-input
                            name="FechaAsignacion"
                            type="date"
                            label="Fecha de Asignación *"
                            value="{{ old('FechaAsignacion', optional($asignacion->FechaAsignacion)->format('Y-m-d')) }}"
                            required
                        />
                    </div>

                    <div class="col-md-6">
                        <label>Estado *</label>
                        @php
                            $estadoActual = old('Estado', $asignacion->Estado);
                        @endphp
                        <select name="Estado" class="form-control" required>
                            <option value="Asignado"   {{ $estadoActual == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                            <option value="En curso"   {{ $estadoActual == 'En curso' ? 'selected' : '' }}>En curso</option>
                            <option value="Finalizado" {{ $estadoActual == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                            <option value="Cancelado"  {{ $estadoActual == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                </div>

                {{-- ================================
                     OBSERVACIONES
                ================================== --}}
                <x-adminlte-textarea
                    name="Observaciones"
                    label="Observaciones"
                    rows="3"
                >{{ old('Observaciones', $asignacion->Observaciones) }}</x-adminlte-textarea>

                {{-- ================================
                     BOTONES
                ================================== --}}
                <div class="mt-4">
                    <x-adminlte-button
                        class="btn-primary"
                        type="submit"
                        label="Actualizar Asignación"
                        icon="fas fa-save"
                    />

                    <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>

                    <a href="{{ route('asignaciones.show', $asignacion->Codigo) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Ver Detalles
                    </a>
                </div>

            </form>
        </div>
    </div>
@stop

@push('css')
    <style>
        .form-control {
            border-radius: 0.375rem;
        }
        select.form-control {
            padding: 0.375rem 0.75rem;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Inicializar select2 si lo estás usando
            if ($.fn.select2) {
                $('select').select2({
                    placeholder: 'Seleccione una opción',
                    allowClear: true,
                    width: '100%'
                });
            }

            // Validación de fecha no futura
            $('input[name="FechaAsignacion"]').on('change', function() {
                const selectedDate = new Date(this.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate > today) {
                    alert('La fecha de asignación no puede ser futura.');
                    this.value = today.toISOString().split('T')[0];
                }
            });
        });
    </script>
@endpush
