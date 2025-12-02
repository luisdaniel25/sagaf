@extends('adminlte::page')

@section('title', 'Asignaciones')
@section('pageHeader', 'Gestión de Asignaciones de Instructores')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('asignaciones.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nueva Asignación
                    </a>
                    <button class="btn btn-outline-secondary" onclick="location.reload()">
                        <i class="fas fa-sync-alt"></i> Actualizar
                    </button>
                </div>

                <div class="form-inline">
                    <label class="mr-2">Mostrar:</label>
                    <select class="form-control form-control-sm" onchange="window.location.href='?per_page=' + this.value">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Instructor</th>
                        <th width="15%">Ficha</th>
                        <th width="20%">Competencia</th>
                        <th width="15%">Ambiente</th>
                        <th width="10%">Fecha</th>
                        <th width="10%">Estado</th>
                        <th width="15%">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($asignaciones as $asignacion)
                        <tr>
                            <td>{{ $asignacion->Codigo }}</td>

                            {{-- INSTRUCTOR --}}
                            <td>
                                @if($asignacion->instructor)
                                    {{ $asignacion->instructor->inst_Nombres ?? '' }}
                                    {{ $asignacion->instructor->inst_Apellido ?? '' }}
                                    <br>
                                    <small class="text-muted">
                                        {{ $asignacion->instructor->inst_Identificacion ?? 'Sin ID' }}
                                    </small>
                                @else
                                    <span class="text-danger">Sin instructor</span>
                                @endif
                            </td>

                            {{-- FICHA --}}
                            <td>
                                @if($asignacion->ficha_caracterizacion)
                                    {{-- CORRECCIÓN: No existe Fic_Numero, usar Codigo --}}
                                    <strong>Ficha #{{ $asignacion->ficha_caracterizacion->Codigo }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        {{ optional($asignacion->ficha_caracterizacion->programa)->prog_Nombre ?? 'Sin programa' }}
                                    </small>
                                @else
                                    <span class="text-danger">-</span>
                                @endif
                            </td>

                            {{-- COMPETENCIA --}}
                            <td>
                                @if($asignacion->competencia)
                                    {{ $asignacion->competencia->comp_Denominacion ?? 'Sin denominación' }}
                                    <br>
                                    <small class="text-muted">
                                        {{ $asignacion->competencia->comp_Horas_FI ?? 0 }} horas
                                    </small>
                                @else
                                    <span class="text-danger">Sin competencia</span>
                                @endif
                            </td>

                            {{-- AMBIENTE --}}
                            <td>
                                @if($asignacion->ambiente)
                                    {{ $asignacion->ambiente->amb_Denominacion ?? 'Sin nombre' }}
                                    <br>
                                    <small class="text-muted">
                                        {{ optional($asignacion->ambiente->tipo_ambiente)->tip_Denominacion ?? 'Sin tipo' }}
                                        (Cupo: {{ $asignacion->ambiente->amb_Cupo ?? 0 }})
                                    </small>
                                @else
                                    <span class="text-info">Virtual</span>
                                @endif
                            </td>

                            {{-- FECHA --}}
                            <td>
                                {{ optional($asignacion->FechaAsignacion)->format('d/m/Y') ?? '-' }}
                            </td>

                            {{-- ESTADO --}}
                            <td>
                                @php
                                    $estado = $asignacion->Estado ?? 'Asignado';
                                    $badge = match ($estado) {
                                        'Asignado'   => 'badge-success',
                                        'En curso'   => 'badge-primary',
                                        'Finalizado' => 'badge-dark',
                                        'Cancelado'  => 'badge-danger',
                                        default      => 'badge-secondary',
                                    };
                                @endphp

                                <span class="badge {{ $badge }}">{{ $estado }}</span>
                            </td>

                            {{-- ACCIONES --}}
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('asignaciones.show', $asignacion->Codigo) }}"
                                       class="btn btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('asignaciones.edit', $asignacion->Codigo) }}"
                                       class="btn btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="button" class="btn btn-warning"
                                            onclick="cambiarEstado({{ $asignacion->Codigo }})"
                                            title="Cambiar estado">
                                        <i class="fas fa-exchange-alt"></i>
                                    </button>

                                    <form action="{{ route('asignaciones.destroy', $asignacion->Codigo) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('¿Seguro de eliminar esta asignación?')"
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle fa-2x mb-2"></i>
                                <br>
                                No hay asignaciones registradas.
                                <br>
                                <a href="{{ route('asignaciones.create') }}" class="btn btn-sm btn-success mt-2">
                                    <i class="fas fa-plus"></i> Crear primera asignación
                                </a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

            {{-- PAGINACIÓN --}}
            @if($asignaciones->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Mostrando {{ $asignaciones->firstItem() }} a {{ $asignaciones->lastItem() }}
                        de {{ $asignaciones->total() }} registros
                    </div>
                    <div>
                        {{ $asignaciones->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif

        </div>

        <div class="card-footer text-muted">
            Total: {{ $asignaciones->total() }} asignaciones
        </div>
    </div>

    <!-- Modal para cambiar estado -->
    <div class="modal fade" id="modalEstado" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formEstado" method="POST">
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
                                <option value="Asignado">Asignado</option>
                                <option value="En curso">En curso</option>
                                <option value="Finalizado">Finalizado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        function cambiarEstado(id) {
            // Configurar el formulario
            $('#formEstado').attr('action', `/asignaciones/${id}/cambiar-estado`);

            // Establecer el estado actual en el select
            const estadoActual = $(`tr:has(td:contains('${id}'))`).find('.badge').text().trim();
            $('select[name="Estado"]').val(estadoActual);

            $('#modalEstado').modal('show');
        }

        // Inicializar tooltips
        $(document).ready(function() {
            $('[title]').tooltip();

            // Confirmación mejorada para eliminación
            $('form[method="POST"]').submit(function(e) {
                if ($(this).attr('method') === 'DELETE') {
                    if (!confirm('¿Está seguro de eliminar esta asignación? Esta acción no se puede deshacer.')) {
                        e.preventDefault();
                    }
                }
            });
        });
    </script>
@endpush
