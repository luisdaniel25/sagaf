@extends('adminlte::page')

@section('title', 'Detalle Tipo de Ambiente')

@section('content_header')
    <h1>Detalle del Tipo de Ambiente</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <p><strong>Código:</strong> {{ $tipo->Codigo }}</p>
                <p><strong>Denominación:</strong> {{ $tipo->tip_Denominacion }}</p>
                <a href="{{ route('tipo-ambientes.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@stop
