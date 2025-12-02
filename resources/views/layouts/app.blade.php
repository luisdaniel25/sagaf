<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistema Académico') }} - @yield('title')</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="brand-link">
            <i class="fas fa-school"></i>
            <span class="brand-text font-weight-light">{{ config('app.name', 'Sistema') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-header">MÓDULOS</li>
                    <li class="nav-item">
                        <a href="{{ route('ambientes.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-door-open"></i>
                            <p>Ambientes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('instructores.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>Instructores</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('asignaciones.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Asignaciones</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('solicitudes.mis-solicitudes') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Solicitudes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('notificaciones.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>Notificaciones</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">@yield('pageHeader', 'Panel de Control')</h1>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>&copy; {{ date('Y') }} {{ config('app.name', 'Sistema Académico') }}.</strong>
        Todos los derechos reservados.
    </footer>

</div>
<!-- ./wrapper -->

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistema Académico') }} - @yield('title')</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="brand-link">
            <i class="fas fa-school"></i>
            <span class="brand-text font-weight-light">{{ config('app.name', 'Sistema') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-header">MÓDULOS</li>
                    <li class="nav-item">
                        <a href="{{ route('ambientes.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-door-open"></i>
                            <p>Ambientes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('instructores.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>Instructores</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('asignaciones.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Asignaciones</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('solicitudes.mis-solicitudes') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Solicitudes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('notificaciones.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>Notificaciones</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">@yield('pageHeader', 'Panel de Control')</h1>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>&copy; {{ date('Y') }} {{ config('app.name', 'Sistema Académico') }}.</strong>
        Todos los derechos reservados.
    </footer>

</div>
<!-- ./wrapper -->

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('scripts')
</body>
</html>
