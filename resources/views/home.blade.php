@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1 class="m-0 text-dark">Bienvenido al Sistema</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center">

                    {{-- Mensaje de estado --}}
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Saludo al usuario --}}
                    <h3 class="mb-3">¡Hola, {{ Auth::user()->name }}!</h3>
                    <p class="text-muted">
                        Has iniciado sesión correctamente en el sistema. Desde aquí puedes supervisar y gestionar
                        tus módulos según tus permisos.
                    </p>

                    <hr>

                    {{-- Último acceso --}}
                    <p class="text-secondary small">
                        Último acceso:
                        @if (Auth::user()->last_login_at)
                            {{ Auth::user()->last_login_at->format('d/m/Y H:i') }}
                        @else
                            Primera vez
                        @endif
                    </p>

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Aquí puedes agregar estilos personalizados --}}
@endsection

@section('js')
    {{-- Aquí puedes agregar scripts personalizados --}}
@endsection
