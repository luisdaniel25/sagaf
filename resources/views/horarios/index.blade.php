@extends('adminlte::page')

@section('title', 'Horarios de Aprendices')

@section('content_header')
    <h1>Horarios de Aprendices</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <form method="GET" action="{{ route('horarios.index') }}">

                <div class="row">

                    <div class="col-md-4">
                        <label>Aprendiz</label>
                        <select name="aprendiz_id" class="form-control select2">
                            <option value="">Todos</option>

                            @foreach($aprendices as $a)
                                <option value="{{ $a->aprendiz_id }}"
                                    @selected(request('aprendiz_id') == $a->aprendiz_id)>

                                    {{ $a->apr_PrimerNombre }}
                                    {{ $a->apr_Apellidos }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Ficha</label>

                        <select name="ficha" class="form-control select2">

                            <option value="">Todas</option>

                            @foreach($fichas as $f)

                                <option value="{{ $f->ficha_codigo }}"
                                    @selected(request('ficha') == $f->ficha_codigo)>

                                    {{ $f->ficha_codigo }}

                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Instructor</label>

                        <select name="instructor" class="form-control select2">

                            <option value="">Todos</option>

                            @foreach($instructores as $i)

                                <option value="{{ $i->instructor }}"
                                    @selected(request('instructor') == $i->instructor)>

                                    {{ $i->instructor }}

                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3 mt-3">
                        <label>Fecha desde</label>

                        <input type="date"
                               name="desde"
                               class="form-control"
                               value="{{ request('desde') }}">
                    </div>

                    <div class="col-md-3 mt-3">
                        <label>Fecha hasta</label>

                        <input type="date"
                               name="hasta"
                               class="form-control"
                               value="{{ request('hasta') }}">
                    </div>

                </div>

                <div class="mt-4">

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Filtrar
                    </button>

                    <a href="{{ route('horarios.index') }}" class="btn btn-secondary">
                        <i class="fas fa-sync"></i>
                        Limpiar
                    </a>

                </div>

            </form>

        </div>
    </div>

    <div class="card mt-3">

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped">

                <thead class="thead-dark">

                <tr>
                    <th>Aprendiz</th>
                    <th>Documento</th>
                    <th>Ficha</th>
                    <th>Programa</th>
                    <th>Evento</th>
                    <th>Competencia</th>
                    <th>Instructor</th>
                    <th>Ambiente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>

                </thead>

                <tbody>

                @forelse($horarios as $h)

                    <tr>

                        <td>{{ $h->apr_PrimerNombre }} {{ $h->apr_Apellidos }}</td>

                        <td>{{ $h->apr_NumeroDocumento }}</td>

                        <td>{{ $h->ficha_codigo }}</td>

                        <td>{{ $h->programa }}</td>

                        <td>{{ $h->evento_titulo }}</td>

                        <td>{{ $h->competencia }}</td>

                        <td>{{ $h->instructor }}</td>

                        <td>{{ $h->ambiente }}</td>

                        <td>{{ optional($h->fecha_inicio)->format('Y-m-d') }}</td>

                        <td>{{ $h->horaInicio }} - {{ $h->horaFinal }}</td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="text-center">
                            No se encontraron resultados
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">
                {{ $horarios->links() }}
            </div>

        </div>

    </div>

@stop

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        $(document).ready(function () {

            $('.select2').select2({
                width: '100%'
            });

        });

    </script>

@stop
