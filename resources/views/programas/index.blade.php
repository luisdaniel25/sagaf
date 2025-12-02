@extends('adminlte::page')

@section('title', 'Programas de Formación')

@section('content_header')
    <h1>Programas de Formación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('programas.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nuevo Programa
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Versión</th>
                        <th>Estado</th>
                        <th>Duración (Meses)</th>
                        <th>Total Horas</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($programasFormacion as $programa)
                        <tr>
                            <td>{{ $programa->prog_codigoPrograma }}</td>
                            <td>{{ $programa->prog_Denominacion }}</td>
                            <td>{{ $programa->prog_version }}</td>
                            <td>
                                    <span class="badge badge-{{ $programa->prog_Estado == 'Activo' ? 'success' : 'secondary' }}">
                                        {{ $programa->prog_Estado ?? 'No definido' }}
                                    </span>
                            </td>
                            <td>{{ $programa->prog_DuracionMeses }}</td>
                            <td>{{ $programa->prog_totalHoras }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('programas.show', $programa->prog_codigoPrograma) }}"
                                       class="btn btn-info btn-sm" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('programas.edit', $programa->prog_codigoPrograma) }}"
                                       class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('programas.destroy', $programa->prog_codigoPrograma) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                title="Eliminar"
                                                onclick="return confirm('¿Está seguro de eliminar este programa?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay programas registrados</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $programasFormacion->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}',
            timer: 3000
        });
        @endif
    </script>
@stop
