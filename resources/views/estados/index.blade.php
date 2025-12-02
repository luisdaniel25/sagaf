@extends('adminlte::page')

@section('title', 'Listado de Ambientes')

@section('content_header')
    <h1>Gestión de Ambientes</h1>
@stop

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            <h3>Listado de Ambientes</h3>
            <a href="{{ route('ambientes.create') }}" class="btn btn-primary">Crear Ambiente</a>
        </div>

        {{-- Filtro de búsqueda --}}
        <form method="GET" class="row mb-3">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por denominación">
            </div>
            <div class="col-md-3">
                <select name="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="1" {{ request('estado') == 1 ? 'selected' : '' }}>Libre</option>
                    <option value="2" {{ request('estado') == 2 ? 'selected' : '' }}>Ocupado</option>
                    <option value="3" {{ request('estado') == 3 ? 'selected' : '' }}>Mantenimiento</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary">Filtrar</button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Denominación</th>
                <th>Tipo</th>
                <th>Cupo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($ambientes as $ambiente)
                <tr>
                    <td>{{ $ambiente->Codigo }}</td>
                    <td>{{ $ambiente->amb_Denominacion }}</td>
                    <td>{{ $ambiente->tipo_ambiente->tip_Denominacion ?? 'N/A' }}</td>
                    <td>{{ $ambiente->amb_Cupo }}</td>
                    <td>
                        @if($ambiente->Codigo_estado == 1)
                            <span class="badge bg-success">Libre</span>
                        @elseif($ambiente->Codigo_estado == 2)
                            <span class="badge bg-danger">Ocupado</span>
                        @elseif($ambiente->Codigo_estado == 3)
                            <span class="badge bg-warning text-dark">Mantenimiento</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('estados.show', $ambiente->Codigo) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('ambientes.edit', $ambiente->Codigo) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('ambientes.destroy', $ambiente->Codigo) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Seguro de eliminar este ambiente?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="d-flex justify-content-end">
            {{ $ambientes->withQueryString()->links() }}
        </div>
    </div>
@endsection
