@extends('adminlte::page')

@section('title', 'Gestionar Competencias')

@section('content_header')
    <h1>Gestionar Competencias - {{ $instructor->inst_Nombres }} {{ $instructor->inst_Apellido }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('instructores.competencias.update', $instructor->Codigo) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label>Competencias:</label>
                    @foreach($competencias as $competencia)
                        <div class="form-check">
                            <input type="checkbox"
                                   name="competencias[]"
                                   value="{{ $competencia->comp_codigoCompetencia }}"
                                   class="form-check-input"
                                {{ $instructor->competencias->contains($competencia->comp_codigoCompetencia) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                {{ $competencia->comp_Denominacion }}
                                ({{ $competencia->comp_Tipo }})
                            </label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Competencias</button>
                <a href="{{ route('instructores.show', $instructor->Codigo) }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
