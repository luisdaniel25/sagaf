@extends('adminlte::page')

@section('title', 'Aprendices')

@section('content_header')
    <h1>Lista de Aprendices</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header">

            <div class="d-flex justify-content-between align-items-center">

                <h3 class="card-title">
                    Gestión de Aprendices
                </h3>

                {{ route('aprendices.create') }} class="btn btn-primary">

                <i class="fas fa-plus"></i>
                Nuevo Aprendiz

                </a>

            </div>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                </div>

            @endif

            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                </div>

            @endif

            <div class="row mb-3">

                <div class="col-md-4">

                    <input
                        type="text"
                        id="searchInput"
                        class="form-control"
                        placeholder="Buscar aprendiz...">

                </div>

            </div>

            <div class="table-responsive">

                <table
                    class="table table-bordered table-striped table-hover"
                    id="aprendicesTable">

                    <thead class="thead-dark">

                    <tr>
                        <th>#</th>
                        <th>Nombre Completo</th>
                        <th>Documento</th>
                        <th>Programa</th>
                        <th>Ficha</th>
                        <th>Centro</th>
                        <th>Estado</th>
                        <th width="150">Acciones</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($aprendices as $index => $aprendiz)

                        <tr>

                            <td>
                                {{ $aprendices->firstItem() + $index }}
                            </td>

                            <td>

                                <strong>
                                    {{ $aprendiz->apr_PrimerNombre }}
                                    {{ $aprendiz->apr_Apellidos }}
                                </strong>

                                @if($aprendiz->apr_SegundoNombre)

                                    <br>

                                    <small class="text-muted">

                                        {{ $aprendiz->apr_SegundoNombre }}

                                    </small>

                                @endif

                            </td>

                            <td>

                                    <span class="badge badge-info">

                                        {{ $aprendiz->apr_TipoDocumento }}

                                    </span>

                                {{ $aprendiz->apr_NumeroDocumento }}

                            </td>

                            <td>

                                    <span class="text-primary">

                                        {{ $aprendiz->programa->prog_Denominacion ?? 'N/A' }}

                                    </span>

                            </td>

                            <td>

                                    <span class="badge badge-secondary">

                                        {{ $aprendiz->ficha_caracterizacion->Codigo ?? 'N/A' }}

                                    </span>

                            </td>

                            <td>

                                {{ $aprendiz->centro_formacion->cent_Denominacion ?? 'N/A' }}

                            </td>

                            <td>

                                @php

                                    $estado =
                                        $aprendiz->apr_FechaFinalizacionFormacion &&
                                        $aprendiz->apr_FechaFinalizacionFormacion->isPast()
                                            ? 'Finalizado'
                                            : 'Activo';

                                @endphp

                                <span
                                    class="badge {{ $estado === 'Activo'
                                            ? 'badge-success'
                                            : 'badge-secondary' }}">

                                        {{ $estado }}

                                    </span>

                            </td>

                            <td>

                                <div class="btn-group" role="group">

                                    .show', $aprendiz) }}"
                                    class="btn btn-info btn-sm"
                                    title="Ver detalles">

                                    <i class="fas fa-eye"></i>

                                    </a>

                                    ', $aprendiz) }}"
                                    class="btn btn-warning btn-sm"
                                    title="Editar">

                                    <i class="fas fa-edit"></i>

                                    </a>

                                    aprendiz) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de eliminar este aprendiz?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        title="Eliminar">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center text-muted py-4">

                                <i class="fas fa-users fa-2x mb-2"></i>

                                <br>

                                No se encontraron aprendices registrados.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            @if($aprendices->hasPages())

                <div
                    class="d-flex justify-content-between align-items-center mt-3">

                    <div class="text-muted">

                        Mostrando
                        {{ $aprendices->firstItem() }}
                        a
                        {{ $aprendices->lastItem() }}
                        de
                        {{ $aprendices->total() }}
                        registros

                    </div>

                    <div>

                        {{ $aprendices->links() }}

                    </div>

                </div>

            @endif

        </div>

    </div>

@stop

@section('css')

    <style>

        .table th {
            background-color: #343a40;
            color: white;
        }

        .btn-group .btn {
            margin-right: 2px;
        }

        .badge {
            font-size: .75em;
        }

    </style>

@stop

@section('js')

    <script>

        $(function () {

            $('#searchInput').on('keyup', function () {

                let value = $(this).val().toLowerCase();

                $('#aprendicesTable tbody tr').filter(function () {

                    $(this).toggle(
                        $(this)
                            .text()
                            .toLowerCase()
                            .indexOf(value) > -1
                    );

                });

            });

            $('.alert').delay(5000).fadeOut(400);

        });

    </script>

@stop
