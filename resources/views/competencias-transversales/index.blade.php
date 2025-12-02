@extends('adminlte::page')

@section('title', 'Competencias Transversales')

@section('content_header')
    <h1>Competencias Transversales</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Listado de competencias transversales</span>
            <a href="{{ route('competencias-transversales.create') }}" class="btn btn-success btn-sm">Nueva Competencia</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Denominación</th>
                    <th>Programa</th>
                    <th>Tipo</th>
                    <th>Créditos</th>
                    <th>Horas</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($competencias as $c)
                    <tr>
                        <td>{{ $c->comp_Denominacion }}</td>
                        <td>{{ $c->programa->Nombre ?? '-' }}</td>
                        <td>{{ $c->comp_Tipo }}</td>
                        <td>{{ $c->comp_Creditos }}</td>
                        <td>{{ $c->comp_Horas_FI }}</td>
                        <td>
                            <a href="{{ route('competencias-transversales.edit', $c) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('competencias-transversales.destroy', $c) }}" method="POST" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta competencia?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
