@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Lista de Eventos</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <a href="{{ route('eventos.create') }}" class="btn btn-primary">Crear Evento</a>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($eventos as $evento)
                <tr>
                    <td>{{ $evento->title }}</td>
                    <td>{{ $evento->descripcion }}</td>
                    <td>{{ \Carbon\Carbon::parse($evento->start)->format('d/m/Y') }} {{ $evento->horaInicio }}</td>
                    <td>{{ \Carbon\Carbon::parse($evento->end)->format('d/m/Y') }} {{ $evento->horaFinal }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar este evento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay eventos registrados.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- Si $eventos es paginado --}}
        @if(method_exists($eventos, 'links'))
            <div class="mt-3">
                {{ $eventos->links() }}
            </div>
        @endif
    </div>
@endsection
