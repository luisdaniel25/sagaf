@extends('adminlte::page')

@section('title', 'Lista de Ambientes')

@section('content_header')
    <h1>Lista de Ambientes</h1>
@stop

@section('content')

    {{-- MENSAJES DE ALERTA --}}
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Éxito" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    @if(session('error'))
        <x-adminlte-alert theme="danger" title="Error" dismissable>
            {{ session('error') }}
        </x-adminlte-alert>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Todos los ambientes</h3>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('ambientes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Ambiente
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            {{-- FILTROS --}}
            <form method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <x-adminlte-input
                            name="search"
                            placeholder="Buscar..."
                            value="{{ request('search') }}"
                        />
                    </div>
                    <div class="col-md-3">
                        <x-adminlte-select name="estado" label="">
                            <option value="">Todos los estados</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->Codigo }}"
                                    {{ request('estado') == $estado->Codigo ? 'selected' : '' }}>
                                    {{ $estado->est_Denominacion }}
                                </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>
                    <div class="col-md-3">
                        <x-adminlte-select name="tipo" label="">
                            <option value="">Todos los tipos</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->Codigo }}"
                                    {{ request('tipo') == $tipo->Codigo ? 'selected' : '' }}>
                                    {{ $tipo->tip_Denominacion }}
                                </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                        <a href="{{ route('ambientes.index') }}" class="btn btn-secondary mt-4">
                            <i class="fas fa-sync"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>

            {{-- TABLA --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Cupo</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($ambientes as $ambiente)
                        <tr>
                            <td>{{ $ambiente->Codigo }}</td>
                            <td>{{ $ambiente->amb_Denominacion }}</td>
                            <td>{{ $ambiente->amb_Cupo }}</td>
                            <td>{{ $ambiente->tipo_ambiente->tip_Denominacion ?? 'N/A' }}</td>
                            <td>
                                    <span class="badge
                                        @if($ambiente->Codigo_estado == 1) badge-success
                                        @elseif($ambiente->Codigo_estado == 2) badge-warning
                                        @else badge-danger @endif">
                                        {{ $ambiente->estado_ambiente->est_Denominacion ?? 'N/A' }}
                                    </span>
                            </td>
                            <td>
                                <a href="{{ route('ambientes.show', $ambiente->Codigo) }}"
                                   class="btn btn-info btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('ambientes.edit', $ambiente->Codigo) }}"
                                   class="btn btn-primary btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('ambientes.destroy', $ambiente->Codigo) }}"
                                      method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                            onclick="return confirm('¿Está seguro de eliminar este ambiente?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No se encontraron ambientes</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINACIÓN --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $ambientes->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .table td {
            vertical-align: middle;
        }
    </style>
@stop
