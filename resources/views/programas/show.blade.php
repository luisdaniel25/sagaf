@extends('adminlte::page')

@section('title', 'Ver Programa de Formación')

@section('content_header')
    <h1>Programa: {{ $programa->prog_Denominacion }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="btn-group">
                <a href="{{ route('programas.edit', $programa->prog_codigoPrograma) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="{{ route('programas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Información Básica</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Código:</th>
                            <td>{{ $programa->prog_codigoPrograma }}</td>
                        </tr>
                        <tr>
                            <th>Denominación:</th>
                            <td>{{ $programa->prog_Denominacion }}</td>
                        </tr>
                        <tr>
                            <th>Versión:</th>
                            <td>{{ $programa->prog_version }}</td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>
                                <span class="badge badge-{{ $programa->prog_Estado == 'Activo' ? 'success' : 'secondary' }}">
                                    {{ $programa->prog_Estado ?? 'No definido' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Nivel de Formación:</th>
                            <td>{{ $programa->prog_NivelFormacion ?? 'No especificado' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5>Duración y Horas</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Duración:</th>
                            <td>{{ $programa->prog_DuracionMeses }} meses</td>
                        </tr>
                        <tr>
                            <th>Horas Estimadas:</th>
                            <td>{{ $programa->prog_HorasEstimadas }}</td>
                        </tr>
                        <tr>
                            <th>Créditos:</th>
                            <td>{{ $programa->prog_Creditos }}</td>
                        </tr>
                        <tr>
                            <th>Etapa Lectiva:</th>
                            <td>{{ $programa->prog_etapaLectiva }} horas</td>
                        </tr>
                        <tr>
                            <th>Etapa Productiva:</th>
                            <td>{{ $programa->prog_etapaProductiva }} horas</td>
                        </tr>
                        <tr>
                            <th>Total Horas:</th>
                            <td>{{ $programa->prog_totalHoras }} horas</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h5>Descripción</h5>
                    <div class="card">
                        <div class="card-body">
                            {{ $programa->prog_Descripcion }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Justificación</h5>
                    <div class="card">
                        <div class="card-body">
                            {{ $programa->prog_justificacion }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h5>Metodología</h5>
                    <div class="card">
                        <div class="card-body">
                            {{ $programa->prog_metodologia }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <small class="text-muted">
                        Creado: {{ $programa->created_at->format('d/m/Y H:i') }} |
                        Actualizado: {{ $programa->updated_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
