@extends('adminlte::page')

@section('title', 'Tipos de Ambiente')

@section('content_header')
    <h1>Tipos de Ambiente</h1>
@stop

@section('content')

    @if(session('success'))
        <x-adminlte-alert theme="success" title="Éxito" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Listado de Tipos</h3>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('tipo-ambientes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Tipo
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Ambientes</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tipos as $tipo)
                        <tr>
                            <td>{{ $tipo->Codigo }}</td>
                            <td>{{ $tipo->tip_Denominacion }}</td>
                            <td>
                                <span class="badge badge-info">{{ $tipo->ambientes->count() }}</span>
                            </td>
                            <td>
                                <a href="{{ route('tipo-ambientes.edit', $tipo->Codigo) }}"
                                   class="btn btn-primary btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tipo-ambientes.destroy', $tipo->Codigo) }}"
                                      method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                            onclick="return confirm('¿Está seguro de eliminar este tipo?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No se encontraron tipos de ambiente</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $tipos->links() }}
            </div>
        </div>
    </div>
@stop
