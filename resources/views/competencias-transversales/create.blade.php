@extends('adminlte::page')

@section('title', 'Nueva Competencia Transversal')

@section('content_header')
    <h1>Crear Nueva Competencia Transversal</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('competencias-transversales.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Denominación</label>
                    <input type="text" name="comp_Denominacion" class="form-control" required value="{{ old('comp_Denominacion') }}">
                </div>
                <div class="form-group">
                    <label>Versión NCL</label>
                    <input type="text" name="comp_VersionNCl" class="form-control" value="{{ old('comp_VersionNCl') }}">
                </div>
                <div class="form-group">
                    <label>Duración Estimada</label>
                    <input type="text" name="comp_DuracionEstimada" class="form-control" value="{{ old('comp_DuracionEstimada') }}">
                </div>
                <div class="form-group">
                    <label>Créditos</label>
                    <input type="number" name="comp_Creditos" class="form-control" value="{{ old('comp_Creditos') }}">
                </div>
                <div class="form-group">
                    <label>Horas FI</label>
                    <input type="number" name="comp_Horas_FI" class="form-control" value="{{ old('comp_Horas_FI') }}">
                </div>
                <div class="form-group">
                    <label>Programa</label>
                    <select name="Codigo_programa" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($programas as $p)
                            <option value="{{ $p->Codigo }}">{{ $p->Nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">Guardar</button>
                <a href="{{ route('competencias-transversales.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
