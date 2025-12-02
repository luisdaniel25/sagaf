@extends('adminlte::page')

@section('title', 'Ficha '.$ficha->Codigo)

@section('content_header')
    <h1>
        <i class="fas fa-file-alt text-primary"></i>
        Detalle de Ficha: {{ $ficha->Codigo }}
    </h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i>
                        Información General
                    </h3>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="40%" class="bg-light">Código de Ficha</th>
                                    <td>
                                    <span class="badge badge-primary badge-lg">
                                        {{ $ficha->Codigo }}
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Fecha Inicio</th>
                                    <td>
                                        <i class="fas fa-calendar-start text-info"></i>
                                        {{ $ficha->fich_Inicio->format('d/m/Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Fecha Fin</th>
                                    <td>
                                        <i class="fas fa-calendar-check text-info"></i>
                                        {{ $ficha->fich_Fin->format('d/m/Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Duración</th>
                                    <td>
                                        <i class="fas fa-clock text-info"></i>
                                        {{ $ficha->fich_Inicio->diffInMonths($ficha->fich_Fin) }} meses
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="40%" class="bg-light">Etapa</th>
                                    <td>
                                    <span class="badge badge-{{ $ficha->fich_Etapa == 'Lectiva' ? 'primary' : 'success' }}">
                                        {{ $ficha->fich_Etapa }}
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Modalidad</th>
                                    <td>{{ $ficha->modalidad->mod_Denominacion ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Programa</th>
                                    <td>
                                        <i class="fas fa-graduation-cap text-warning"></i>
                                        {{ $ficha->programa->prog_Denominacion ?? '—' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Centro</th>
                                    <td>
                                        <i class="fas fa-building text-warning"></i>
                                        {{ $ficha->centro_formacion->cent_Denominacion ?? '—' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($ficha->aprendizs->count() > 0)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        <h4 class="card-title mb-0">
                                            <i class="fas fa-users"></i>
                                            Aprendices Asociados ({{ $ficha->aprendizs->count() }})
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Nombre Completo</th>
                                                    <th>Email</th>
                                                    <th>Teléfono</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ficha->aprendizs as $aprendiz)
                                                    <tr>
                                                        <td>{{ $aprendiz->apr_Documento }}</td>
                                                        <td>{{ $aprendiz->apr_Nombre }} {{ $aprendiz->apr_Apellido }}</td>
                                                        <td>{{ $aprendiz->apr_Email ?? '—' }}</td>
                                                        <td>{{ $aprendiz->apr_Telefono ?? '—' }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    Esta ficha no tiene aprendices asociados.
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="card-footer text-center">
                    <div class="btn-group" role="group">
                        <a href="{{ route('fichas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>

                        <a href="{{ route('fichas.edit', $ficha->Codigo) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar Ficha
                        </a>

                        <form action="{{ route('fichas.destroy', $ficha->Codigo) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar esta ficha? Esta acción no se puede deshacer.')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <style>
        .badge-lg {
            font-size: 1.1em;
            padding: 0.5em 0.8em;
        }
        .table th {
            font-weight: 600;
        }
        .card-header {
            border-bottom: 2px solid #dee2e6;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
@stop
