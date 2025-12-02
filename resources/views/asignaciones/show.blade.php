@extends('adminlte::page')

@section('title', 'Detalle de Asignación')

@section('content_header')
    <h1>Detalle de Asignación #{{ $asignacion->Codigo }}</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    @php
                        $badge = match ($asignacion->Estado) {
                            'Asignado'   => 'badge-success',
                            'En curso'   => 'badge-primary',
                            'Finalizado' => 'badge-dark',
                            'Cancelado'  => 'badge-danger',
                            default      => 'badge-secondary',
                        };
                    @endphp
                    <span class="badge {{ $badge }}">{{ $asignacion->Estado ?? 'Pendiente' }}</span>
                </div>
                <div>
                    <small class="text-muted">
                        Creado: {{ optional($asignacion->created_at)->format('d/m/Y H:i') ?? 'N/A' }} |
                        Actualizado: {{ optional($asignacion->updated_at)->format('d/m/Y H:i') ?? 'N/A' }}
                    </small>
                </div>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">
                <tbody>
                {{-- INSTRUCTOR --}}
                <tr>
                    <th width="30%">Instructor</th>
                    <td>
                        @php
                            $inst = $asignacion->instructor;
                            $nombreInst = $inst ? ($inst->inst_Nombres . ' ' . $inst->inst_Apellido) : null;
                            $documento = $inst?->inst_Identificacion ?? 'N/A';
                        @endphp

                        @if($nombreInst)
                            <strong>{{ $nombreInst }}</strong>
                            <br>
                            <small class="text-muted">Documento: {{ $documento }}</small>
                            <br>
                            <small class="text-muted">Correo: {{ $inst->inst_Correo ?? 'Sin correo' }}</small>
                        @else
                            <span class="text-danger">Sin instructor asignado</span>
                        @endif
                    </td>
                </tr>

                {{-- FICHA --}}
                <tr>
                    <th>Ficha</th>
                    <td>
                        @php
                            $ficha = $asignacion->ficha_caracterizacion;
                            // CORRECCIÓN: No existe Fic_Numero, usar Codigo
                            $numFicha = $ficha?->Codigo;
                            $programa = optional($ficha?->programa)->prog_Nombre ?? 'Sin programa';
                            $etapa = $ficha?->fich_Etapa ?? 'N/A';
                        @endphp

                        @if($numFicha)
                            <strong>Ficha #{{ $numFicha }}</strong>
                            <br>
                            <small class="text-muted">
                                Programa: {{ $programa }} |
                                Etapa: {{ $etapa }} |
                                Inicio: {{ optional($ficha?->fich_Inicio)->format('d/m/Y') ?? 'N/A' }} -
                                Fin: {{ optional($ficha?->fich_Fin)->format('d/m/Y') ?? 'N/A' }}
                            </small>
                        @else
                            <span class="text-danger">Sin ficha asignada</span>
                        @endif
                    </td>
                </tr>

                {{-- COMPETENCIA --}}
                <tr>
                    <th>Competencia</th>
                    <td>
                        @php
                            $comp = $asignacion->competencia;
                            $nomComp = $comp?->comp_Denominacion ?? 'Sin denominación';
                            $codigoComp = $comp?->comp_codigoCompetencia ?? 'N/A';
                            $horas = $comp?->comp_Horas_FI ?? 0;
                            $creditos = $comp?->comp_Creditos ?? 0;
                            $tipo = $comp?->comp_Tipo ?? 'N/A';
                        @endphp

                        <strong>{{ $nomComp }}</strong>
                        <br>
                        <small class="text-muted">
                            Código: {{ $codigoComp }} |
                            Tipo: {{ $tipo }} |
                            Horas: {{ $horas }} |
                            Créditos: {{ $creditos }}
                        </small>
                    </td>
                </tr>

                {{-- AMBIENTE --}}
                <tr>
                    <th>Ambiente</th>
                    <td>
                        @if($asignacion->ambiente)
                            @php
                                $ambiente = $asignacion->ambiente;
                                $nombreAmb = $ambiente->amb_Denominacion ?? 'Sin nombre';
                                // CORRECCIÓN: Usar optional() para evitar errores
                                $tipoAmb = optional($ambiente->tipo_ambiente)->tip_Denominacion ?? 'Sin tipo';
                                $estadoAmb = optional($ambiente->estado_ambiente)->est_Denominacion ?? 'Sin estado';
                                $cupo = $ambiente->amb_Cupo ?? 0; // CORRECCIÓN: Es amb_Cupo, no amb_Capacidad
                            @endphp

                            <strong>{{ $nombreAmb }}</strong>
                            <br>
                            <small class="text-muted">
                                Tipo: {{ $tipoAmb }} |
                                Estado: {{ $estadoAmb }} |
                                Cupo: {{ $cupo }}
                            </small>
                        @else
                            <span class="text-info">Sin ambiente (virtual)</span>
                        @endif
                    </td>
                </tr>

                {{-- FECHA ASIGNACIÓN --}}
                <tr>
                    <th>Fecha Asignación</th>
                    <td>
                        {{ optional($asignacion->FechaAsignacion)->format('d/m/Y H:i') ?? '-' }}
                        @if($asignacion->FechaAsignacion)
                            <br>
                            <small class="text-muted">
                                ({{ $asignacion->FechaAsignacion->diffForHumans() }})
                            </small>
                        @endif
                    </td>
                </tr>

                {{-- OBSERVACIONES --}}
                <tr>
                    <th>Observaciones</th>
                    <td>
                        @if($asignacion->Observaciones)
                            <div class="bg-light p-3 rounded">
                                {{ $asignacion->Observaciones }}
                            </div>
                        @else
                            <span class="text-muted">Ninguna observación registrada</span>
                        @endif
                    </td>
                </tr>

                </tbody>
            </table>

            {{-- NOTIFICACIONES --}}
            @if($asignacion->notificaciones && $asignacion->notificaciones->count() > 0)
                <div class="mt-4">
                    <h5>Notificaciones relacionadas</h5>
                    <div class="list-group">
                        @foreach($asignacion->notificaciones as $notificacion)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $notificacion->titulo ?? 'Sin título' }}</strong>
                                    <small class="text-muted">{{ optional($notificacion->created_at)->format('d/m/Y H:i') }}</small>
                                </div>
                                <p class="mb-0">{{ $notificacion->mensaje ?? 'Sin mensaje' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>

                <div>
                    <a href="{{ route('asignaciones.edit', $asignacion->Codigo) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalCambiarEstado">
                        <i class="fas fa-exchange-alt"></i> Cambiar Estado
                    </button>

                    <form action="{{ route('asignaciones.destroy', $asignacion->Codigo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta asignación? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para cambiar estado -->
    <div class="modal fade" id="modalCambiarEstado" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('asignaciones.cambiarEstado', $asignacion->Codigo) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Cambiar Estado de Asignación</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nuevo Estado</label>
                            <select name="Estado" class="form-control" required>
                                <option value="Asignado" {{ $asignacion->Estado == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                                <option value="En curso" {{ $asignacion->Estado == 'En curso' ? 'selected' : '' }}>En curso</option>
                                <option value="Finalizado" {{ $asignacion->Estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                <option value="Cancelado" {{ $asignacion->Estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Estado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@push('css')
    <style>
        .table th {
            background-color: #f8f9fa;
        }
        .list-group-item {
            border-left: 4px solid #007bff;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Inicializar tooltips si es necesario
            $('[data-toggle="tooltip"]').tooltip();

            // Mejorar experiencia del modal
            $('#modalCambiarEstado').on('shown.bs.modal', function () {
                $('select[name="Estado"]').focus();
            });
        });
    </script>
@endpush
