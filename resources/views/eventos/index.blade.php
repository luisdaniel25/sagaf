@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1>Lista de Eventos</h1>

            <a href="{{ route('eventos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Crear Evento
            </a>

        </div>

        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">

                {{ session('success') }}

                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Cerrar">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

        @endif

        <div class="card">

            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover table-striped">

                    <thead class="thead-dark">

                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th width="220">Acciones</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($eventos as $evento)

                        <tr>

                            <td>{{ $evento->title }}</td>

                            <td>{{ $evento->descripcion }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($evento->start)->format('d/m/Y') }}
                                <br>
                                <small class="text-muted">{{ $evento->horaInicio }}</small>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($evento->end)->format('d/m/Y') }}
                                <br>
                                <small class="text-muted">{{ $evento->horaFinal }}</small>
                            </td>

                            <td>

                                <a href="{{ route('eventos.show', $evento->id) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('eventos.edit', $evento->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('eventos.destroy', $evento->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Desea eliminar este evento?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">

                                No hay eventos registrados.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        @if(method_exists($eventos,'links'))

            <div class="mt-3">

                {{ $eventos->links() }}

            </div>

        @endif

    </div>

@endsection
