@extends('adminlte::page')

@section('title', 'Detalle del Aprendiz')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalle del Aprendiz</h1>
        <div>
            <a href="{{ route('aprendices.edit', $aprendiz->Codigo) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('aprendices.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Tarjeta de Información Personal -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user"></i> Información Personal
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="user-avatar bg-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                             style="width: 80px; height: 80px; font-size: 2rem;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <h4 class="mt-2 mb-0">{{ $aprendiz->apr_PrimerNombre }} {{ $aprendiz->apr_Apellidos }}</h4>
                        <span class="text-muted">{{ $aprendiz->apr_NumeroDocumento }}</span>
                    </div>

                    <table class="table table-sm">
                        <tr>
                            <th width="40%"><i class="fas fa-id-card text-muted"></i> Tipo Doc:</th>
                            <td>
                                <span class="badge badge-info">{{ $aprendiz->apr_TipoDocumento }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-birthday-cake text-muted"></i> Fecha Nacimiento:</th>
                            <td>{{ $aprendiz->apr_FechaNacimiento->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-phone text-muted"></i> Teléfono:</th>
                            <td>{{ $aprendiz->apr_Telefono ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fab fa-whatsapp text-muted"></i> WhatsApp:</th>
                            <td>{{ $aprendiz->apr_TelefonoWhatsapp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-map-marker-alt text-muted"></i> Dirección:</th>
                            <td>{{ $aprendiz->apr_Direccion ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Tarjeta de Contacto -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-envelope"></i> Información de Contacto
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th width="40%"><i class="fas fa-envelope text-muted"></i> Correo Personal:</th>
                            <td>
                                @if($aprendiz->apr_CorreoPersonal)
                                    <a href="mailto:{{ $aprendiz->apr_CorreoPersonal }}">{{ $aprendiz->apr_CorreoPersonal }}</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-envelope text-muted"></i> Correo SENA:</th>
                            <td>
                                @if($aprendiz->apr_CorreoSena)
                                    <a href="mailto:{{ $aprendiz->apr_CorreoSena }}">{{ $aprendiz->apr_CorreoSena }}</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Tarjeta de Información Académica -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-graduation-cap"></i> Información Académica
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%"><i class="fas fa-book text-muted"></i> Programa:</th>
                                    <td>
                                        <span class="text-success font-weight-bold">
                                            {{ $aprendiz->programa->prog_Denominacion ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-file-alt text-muted"></i> Ficha:</th>
                                    <td>
                                        <span class="badge badge-secondary">
                                            {{ $aprendiz->ficha_caracterizacion->Codigo ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-university text-muted"></i> Centro:</th>
                                    <td>{{ $aprendiz->centro_formacion->cent_Denominacion ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-map text-muted"></i> Regional:</th>
                                    <td>{{ $aprendiz->regionale->reg_Nombre ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%"><i class="fas fa-clock text-muted"></i> Jornada:</th>
                                    <td>
                                        <span class="badge badge-primary">{{ $aprendiz->apr_Jornada }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-laptop text-muted"></i> Modalidad:</th>
                                    <td>
                                        <span class="badge badge-info">{{ $aprendiz->apr_ModalidadFormacion }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-building text-muted"></i> Sede:</th>
                                    <td>{{ $aprendiz->apr_SedeFormacion }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Fechas -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt"></i> Cronología de Formación
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%"><i class="fas fa-play-circle text-muted"></i> Inicio Formación:</th>
                                    <td>
                                        <span class="font-weight-bold">
                                            {{ $aprendiz->apr_FechaInicioFormacion->format('d/m/Y') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-flag-checkered text-muted"></i> Fin Formación:</th>
                                    <td>
                                        @if($aprendiz->apr_FechaFinalizacionFormacion)
                                            <span class="font-weight-bold">
                                                {{ $aprendiz->apr_FechaFinalizacionFormacion->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="text-muted">No definida</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                @php
                                    $fechaFin = $aprendiz->apr_FechaFinalizacionFormacion;
                                    $hoy = now();
                                    $estado = $fechaFin && $fechaFin->lt($hoy) ? 'Finalizado' : 'Activo';
                                    $badgeClass = $estado === 'Activo' ? 'badge-success' : 'badge-secondary';
                                    $iconClass = $estado === 'Activo' ? 'fa-check-circle' : 'fa-graduation-cap';
                                @endphp
                                <div class="mb-2">
                                    <i class="fas {{ $iconClass }} fa-3x text-{{ $estado === 'Activo' ? 'success' : 'secondary' }}"></i>
                                </div>
                                <h4>
                                    <span class="badge {{ $badgeClass }} badge-lg p-2">
                                        {{ $estado }}
                                    </span>
                                </h4>
                                @if($fechaFin && $fechaFin->gt($hoy))
                                    <small class="text-muted">
                                        Finaliza en {{ $hoy->diffInDays($fechaFin) }} días
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Acciones Rápidas -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bolt"></i> Acciones Rápidas
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <a href="{{ route('aprendices.edit', $aprendiz->Codigo) }}" class="btn btn-warning btn-block">
                                <i class="fas fa-edit"></i><br>
                                <small>Editar</small>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-info btn-block" onclick="window.print()">
                                <i class="fas fa-print"></i><br>
                                <small>Imprimir</small>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('aprendices.destroy', $aprendiz->Codigo) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block"
                                        onclick="return confirm('¿Está seguro de eliminar al aprendiz {{ $aprendiz->apr_PrimerNombre }} {{ $aprendiz->apr_Apellidos }}?')">
                                    <i class="fas fa-trash"></i><br>
                                    <small>Eliminar</small>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('aprendices.index') }}" class="btn btn-secondary btn-block">
                                <i class="fas fa-list"></i><br>
                                <small>Listado</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1rem;
        }
        .table th {
            border: none;
            font-weight: 600;
        }
        .table td {
            border: none;
        }
        .table tr {
            border-bottom: 1px solid #dee2e6;
        }
        .badge-lg {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        .user-avatar {
            background: linear-gradient(45deg, #007bff, #6610f2);
        }
        .btn-block {
            padding: 0.75rem;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            console.log('Vista de detalle del aprendiz cargada');
        });
    </script>
@stop
