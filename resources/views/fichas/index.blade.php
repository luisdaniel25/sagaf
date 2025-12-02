@extends('adminlte::page')

@section('title', 'Fichas')

@section('content_header')
    <h1>Fichas de Caracterización</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <form action="{{ route('fichas.index') }}" method="GET" class="form-inline">
                <input type="text"
                       name="search"
                       class="form-control mr-2"
                       placeholder="Buscar por número de ficha"
                       value="{{ request('search') }}">

                <button class="btn btn-primary">
                    <i class="fas fa-search"></i> Buscar
                </button>

                <a href="{{ route('fichas.index') }}" class="btn btn-secondary ml-2">
                    <i class="fas fa-undo"></i> Limpiar
                </a>

                <a href="{{ route('fichas.create') }}" class="btn btn-success ml-3">
                    <i class="fas fa-plus"></i> Nueva Ficha
                </a>
            </form>
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

            @if($fichas->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>N° Ficha (Código)</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Etapa</th>
                            <th>Modalidad</th>
                            <th>Programa</th>
                            <th>Centro</th>
                            <th width="150">Opciones</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($fichas as $ficha)
                            <tr>
                                <td><strong>{{ $ficha->Codigo }}</strong></td>
                                <td>{{ $ficha->fich_Inicio->format('Y-m-d') }}</td>
                                <td>{{ $ficha->fich_Fin->format('Y-m-d') }}</td>
                                <td>
                                <span class="badge badge-{{ $ficha->fich_Etapa == 'Lectiva' ? 'primary' : 'success' }}">
                                    {{ $ficha->fich_Etapa }}
                                </span>
                                </td>
                                <td>{{ $ficha->modalidad->mod_Denominacion ?? '—' }}</td>
                                <td>{{ $ficha->programa->prog_Denominacion ?? '—' }}</td>
                                <td>{{ $ficha->centro_formacion->cent_Denominacion ?? '—' }}</td>

                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('fichas.show', $ficha->Codigo) }}" class="btn btn-info" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('fichas.edit', $ficha->Codigo) }}" class="btn btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('fichas.destroy', $ficha->Codigo) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar la ficha {{ $ficha->Codigo }}?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Mostrando {{ $fichas->firstItem() }} a {{ $fichas->lastItem() }} de {{ $fichas->total() }} registros
                    </div>
                    <div>
                        {{ $fichas->links() }}
                    </div>
                </div>

            @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No se encontraron fichas de caracterización.</p>
                    @if(request('search'))
                        <a href="{{ route('fichas.index') }}" class="btn btn-primary">
                            <i class="fas fa-undo"></i> Ver todas las fichas
                        </a>
                    @else
                        <a href="{{ route('fichas.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Crear primera ficha
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

@stop

@section('css')
    <style>
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        .btn-group .btn {
            margin-right: 2px;
        }
        .form-inline .form-control {
            width: 300px;
        }
        @media (max-width: 768px) {
            .form-inline .form-control {
                width: 100%;
                margin-bottom: 10px;
            }
            .form-inline .btn {
                margin-bottom: 10px;
            }
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

            // Confirmación para eliminar
            $('form[method="POST"]').on('submit', function(e) {
                var form = this;
                e.preventDefault();

                if (confirm('¿Está seguro de eliminar esta ficha? Esta acción no se puede deshacer.')) {
                    form.submit();
                }
            });
        });
    </script>
@stop
