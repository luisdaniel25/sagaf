@extends('adminlte::page')

@section('title', 'Nuevo Instructor')

@section('content_header')
    <h1>Registrar Nuevo Instructor</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('instructores.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label>Nombres</label>
                        <input type="text" name="inst_Nombres" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Apellidos</label>
                        <input type="text" name="inst_Apellido" class="form-control" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Identificación</label>
                        <input type="text" name="inst_Identificacion" class="form-control" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Correo</label>
                        <input type="email" name="inst_Correo" class="form-control" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Teléfono</label>
                        <input type="text" name="inst_Telefono" class="form-control">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Dirección</label>
                        <input type="text" name="inst_Direccion" class="form-control">
                    </div>
                    <div class="col-md-6 mt-3">
                    <select name="Codigo_vigencia" class="form-control" required>
                        @foreach ($vigencias as $v)
                            <option value="{{ $v->Codigo }}"> {{-- Usar Codigo en lugar de id --}}
                                {{ $v->vig_Estado ? 'Activa' : 'Inactiva' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                </div>

                <button type="submit" class="btn btn-success mt-4">Guardar</button>
                <a href="{{ route('instructores.index') }}" class="btn btn-secondary mt-4">Cancelar</a>
            </form>

        </div>
    </div>

@stop
