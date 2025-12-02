@extends('adminlte::page')

@section('title', 'Editar Solicitud')

@section('content_header')
    <h1>Editar Solicitud de Programación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('solicitudes.update', $solicitud->Codigo) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-6">
                        <label>Competencia:</label>
                        <select name="Codigo_competencia" class="form-control" required>
                            <option value="">Seleccione...</option>
                            @foreach($competencias as $c)
                                <option value="{{ $c->comp_codigoCompetencia }}"
                                    {{ $solicitud->Codigo_competencia == $c->comp_codigoCompetencia ? 'selected' : '' }}>
                                    {{ $c->comp_Denominacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Ficha:</label>
                        <select name="Codigo_ficha" class="form-control" required>
                            <option value="">Seleccione...</option>
                            @foreach($fichas as $f)
                                <option value="{{ $f->Codigo }}"
                                    {{ $solicitud->Codigo_ficha == $f->Codigo ? 'selected' : '' }}>
                                    Ficha {{ $f->Codigo }} ({{ $f->fich_Etapa }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Fecha Propuesta:</label>
                        <input type="date" name="sol_FechaPropuesta" class="form-control"
                               value="{{ $solicitud->sol_FechaPropuesta->format('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Horas Solicitadas:</label>
                        <input type="number" name="sol_HorasSolicitadas" class="form-control"
                               value="{{ $solicitud->sol_HorasSolicitadas }}" required min="1">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>Justificación:</label>
                        <textarea name="sol_Justificacion" class="form-control" rows="4" required>{{ $solicitud->sol_Justificacion }}</textarea>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="sol_Estado">Estado</label>
                        <select name="sol_Estado" id="sol_Estado" class="form-control" required>
                            <option value="Pendiente" {{ $solicitud->sol_Estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Aprobada" {{ $solicitud->sol_Estado == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                            <option value="Rechazada" {{ $solicitud->sol_Estado == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar Solicitud</button>
                    <a href="{{ route('solicitudes.mis-solicitudes') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop
