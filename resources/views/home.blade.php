@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1 class="m-0 text-dark">
        Bienvenido al Sistema
    </h1>
@stop

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    @if(session('status'))

                        <div
                            class="alert alert-success alert-dismissible fade show"
                            role="alert">

                            {{ session('status') }}

                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Cerrar">

                                <span aria-hidden="true">
                                    &times;
                                </span>

                            </button>

                        </div>

                    @endif

                    <h3 class="mb-3">
                        ¡Hola, {{ Auth::user()->name }}!
                    </h3>

                    <p class="text-muted">
                        Has iniciado sesión correctamente en el sistema.
                        Desde aquí puedes supervisar y gestionar los módulos
                        disponibles según los permisos asignados a tu usuario.
                    </p>

                    <hr>

                    <div class="row text-center">

                        <div class="col-md-6">

                            <div class="border rounded p-3">

                                <h5>
                                    Usuario
                                </h5>

                                <p class="mb-0">
                                    {{ Auth::user()->email }}
                                </p>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="border rounded p-3">

                                <h5>
                                    Último acceso
                                </h5>

                                <p class="mb-0">

                                    @if(Auth::user()->last_login_at)

                                        {{ Auth::user()->last_login_at->format('d/m/Y H:i') }}

                                    @else

                                        Primera vez

                                    @endif

                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="mt-4">

                        }}"
                        class="btn btn-primary">

                        <i class="fas fa-calendar-alt"></i>
                        Ver Horarios

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop

@section('css')
@stop

@section('js')
@stop
