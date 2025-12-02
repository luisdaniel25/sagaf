@extends('adminlte::page')

@section('title', 'Reporte de Competencias Transversales')

@section('content_header')
    <h1>Reporte de Competencias Transversales</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Denominación</th>
                    <th>Programa</th>
                    <th>Tipo</th>
                    <th>Créditos</th>
                    <th>Horas</th>
                    <th>Creado</th>
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
                        <td>{{ $c->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
