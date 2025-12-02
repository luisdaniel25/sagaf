@extends('adminlte::page')

@section('title', 'Instructores')

@section('content_header')
    <h1>Listado de Instructores</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('instructores.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Instructor
            </a>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Vigencia</th>
                    <th style="width: 180px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($instructores as $instructor)
                    <tr>
                        <td>{{ $instructor->Codigo }}</td>
                        <td>{{ $instructor->inst_Nombres }} {{ $instructor->inst_Apellido }}</td>
                        <td>{{ $instructor->inst_Identificacion }}</td>
                        <td>{{ $instructor->inst_Correo }}</td>
                        <td>{{ $instructor->inst_Telefono }}</td>
                        <td>
    <span class="badge {{ $instructor->vigencia && $instructor->vigencia->vig_Estado ? 'badge-success' : 'badge-danger' }}">
        {{ $instructor->vigencia ? ($instructor->vigencia->vig_Estado ? 'Activa' : 'Inactiva') : 'No asignada' }}
    </span>
                        </td>

                        <td>
                            <a href="{{ route('instructores.show', $instructor->Codigo) }}"
                               class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('instructores.edit', $instructor->Codigo) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('instructores.destroy', $instructor->Codigo) }}"
                                  method="POST"
                                  style="display:inline-block;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Seguro que deseas eliminar este instructor?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
