@extends('adminlte::page')

@section('title', 'Editar Instructor')

@section('content_header')
    <h1>Editar Instructor</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('instructores.update', $instructor->Codigo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6">
                        <label>Nombres</label>
                        <input type="text" name="inst_Nombres" class="form-control"
                               value="{{ $instructor->inst_Nombres }}" required>
                    </div>

                    <div class="col-md-6">
                        <label>Apellidos</label>
                        <input type="text" name="inst_Apellido" class="form-control"
                               value="{{ $instructor->inst_Apellido }}" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Identificación</label>
                        <input type="text" name="inst_Identificacion" class="form-control"
                               value="{{ $instructor->inst_Identificacion }}" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Correo</label>
                        <input type="email" name="inst_Correo" class="form-control"
                               value="{{ $instructor->inst_Correo }}" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Teléfono</label>
                        <input type="text" name="inst_Telefono" class="form-control"
                               value="{{ $instructor->inst_Telefono }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Dirección</label>
                        <input type="text" name="inst_Direccion" class="form-control"
                               value="{{ $instructor->inst_Direccion }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Vigencia</label>
                        <select name="vigencia_id" class="form-control" required>
                            @foreach ($vigencias as $v)
                                <option value="{{ $v->id }}"
                                    {{ $instructor->vigencia_id == $v->id ? 'selected' : '' }}>
                                    {{ $v->vig_Estado ? 'Activa' : 'Inactiva' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary mt-4">Actualizar</button>
                <a href="{{ route('instructores.index') }}" class="btn btn-secondary mt-4">Cancelar</a>

            </form>

        </div>
    </div>

@stop
