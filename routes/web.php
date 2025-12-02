<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\TipoAmbienteController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\AsignacionesInstructoresController;
use App\Http\Controllers\SolicitudCompetenciaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\FichaCaracterizacionController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\VwHorariosAprendiceController;
use App\Http\Controllers\ProgramacionController;
use App\Http\Controllers\AprendicesController;
use App\Http\Controllers\ProgramaFormacionController;

/*
|--------------------------------------------------------------------------
| Autenticación + Home
|--------------------------------------------------------------------------
*/
Auth::routes();

// Redirigir la raíz al listado de horarios
Route::get('/', function () {
    return redirect()->route('horarios.index');
})->name('inicio');

Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| AJAX / API para Fichas
|--------------------------------------------------------------------------
*/
Route::prefix('api')->name('api.')->group(function () {
    Route::get('centros-por-regional/{regional}', [FichaCaracterizacionController::class, 'centrosPorRegional'])->name('centrosPorRegional');
    Route::get('programas-por-centro/{centro}', [FichaCaracterizacionController::class, 'programasPorCentro'])->name('programasPorCentro');
});

/*
|--------------------------------------------------------------------------
| Ambientes
|--------------------------------------------------------------------------
*/
Route::resources([
    'ambientes' => AmbienteController::class,
], [
    'parameters' => [
        'ambientes' => 'ambiente',
    ],
]);

Route::prefix('ambientes')->name('ambientes.')->group(function () {
    Route::post('{ambiente}/liberar', [AmbienteController::class, 'liberar'])->name('liberar');
    Route::post('{ambiente}/mantenimiento', [AmbienteController::class, 'ponerEnMantenimiento'])->name('mantenimiento');
});

/*
|--------------------------------------------------------------------------
| Aprendices
|--------------------------------------------------------------------------
*/
Route::resource('aprendices', AprendicesController::class);

/*
|--------------------------------------------------------------------------
| Asignaciones de Instructores (CRUD + disponibilidad)
|--------------------------------------------------------------------------
*/
Route::resource('asignaciones', AsignacionesInstructoresController::class)
    ->parameters(['asignaciones' => 'asignacion']);

// Agrega esta ruta para cambiar estado
Route::post('asignaciones/{asignacion}/cambiar-estado',
    [AsignacionesInstructoresController::class, 'cambiarEstado'])
    ->name('asignaciones.cambiarEstado');

Route::get('asignaciones/instructor/{instructorId}/disponibilidad',
    [AsignacionesInstructoresController::class, 'disponibilidad'])
    ->name('asignaciones.disponibilidad');

/*
|--------------------------------------------------------------------------
| Eventos
|--------------------------------------------------------------------------
*/
Route::resources([
    'eventos' => EventoController::class,
], [
    'parameters' => [
        'eventos' => 'evento',
    ],
]);

/*
|--------------------------------------------------------------------------
| Fichas de Caracterización
|--------------------------------------------------------------------------
*/
Route::resources([
    'fichas' => FichaCaracterizacionController::class,
], [
    'parameters' => [
        'fichas' => 'ficha',
    ],
]);

/*
|--------------------------------------------------------------------------
| Horarios de Aprendices (FullCalendar, filtros, etc.)
|--------------------------------------------------------------------------
*/
Route::prefix('horarios')->name('horarios.')->group(function () {
    Route::get('/', [VwHorariosAprendiceController::class, 'index'])->name('index');
    Route::get('aprendiz/{id}', [VwHorariosAprendiceController::class, 'porAprendiz'])->name('porAprendiz');
    Route::get('calendario', [VwHorariosAprendiceController::class, 'calendario'])->name('calendario');
    Route::get('calendario-data', [VwHorariosAprendiceController::class, 'calendarioData'])->name('calendario.data');
    Route::get('evento/{id}', [VwHorariosAprendiceController::class, 'porEvento'])->name('porEvento');
    Route::get('fecha', [VwHorariosAprendiceController::class, 'porFecha'])->name('porFecha');
    Route::get('ficha/{codigo}', [VwHorariosAprendiceController::class, 'porFicha'])->name('porFicha');
    Route::get('rango', [VwHorariosAprendiceController::class, 'porRango'])->name('porRango');
});

/*
|--------------------------------------------------------------------------
| Instructores
|--------------------------------------------------------------------------
*/
Route::resources([
    'instructores' => InstructorController::class,
], [
    'parameters' => [
        'instructores' => 'instructor',
    ],
]);

/*
|--------------------------------------------------------------------------
| Notificaciones
|--------------------------------------------------------------------------
*/
Route::prefix('notificaciones')->name('notificaciones.')->group(function () {
    Route::get('/', [NotificacionController::class, 'index'])->name('index');
    Route::get('contar-no-leidas', [NotificacionController::class, 'contarNoLeidas'])->name('contarNoLeidas');
    Route::get('no-leidas', [NotificacionController::class, 'noLeidas'])->name('noLeidas');
    Route::patch('marcar-todas-leidas', [NotificacionController::class, 'marcarTodasLeidas'])->name('marcarTodasComoLeidas');
    Route::patch('{id}/archivar', [NotificacionController::class, 'archivar'])->name('archivar');
    Route::patch('{id}/marcar-leida', [NotificacionController::class, 'marcarLeida'])->name('marcarLeida');
});

/*
|--------------------------------------------------------------------------
| Programación Académica
|--------------------------------------------------------------------------
*/
Route::prefix('programacion')->name('programacion.')->group(function () {
    Route::get('/', [ProgramacionController::class, 'index'])->name('index');
    Route::get('ficha/{fichaId}', [ProgramacionController::class, 'porFicha'])->name('ficha');
    Route::get('ficha/{fichaId}/create', [ProgramacionController::class, 'create'])->name('create');
    Route::post('/', [ProgramacionController::class, 'store'])->name('store');
});

/*
|--------------------------------------------------------------------------
| Programas de Formación
|--------------------------------------------------------------------------
*/
Route::resource('programas', ProgramaFormacionController::class);

/*
|--------------------------------------------------------------------------
| Solicitudes de Competencias Transversales
|--------------------------------------------------------------------------
*/
Route::prefix('solicitudes')->name('solicitudes.')->group(function () {
    Route::resource('/', SolicitudCompetenciaController::class)
        ->parameters(['' => 'solicitud'])
        ->names([
            'index'   => 'index',
            'create'  => 'create',
            'store'   => 'store',
            'show'    => 'show',
            'edit'    => 'edit',
            'update'  => 'update',
            'destroy' => 'destroy',
        ])->shallow();

    Route::get('coordinador', [SolicitudCompetenciaController::class, 'indexCoordinador'])->name('coordinador');
    Route::get('mis-solicitudes', [SolicitudCompetenciaController::class, 'misSolicitudes'])->name('mis-solicitudes');
    Route::post('{solicitud}/aprobar', [SolicitudCompetenciaController::class, 'aprobar'])->name('coordinador.aprobar');
    Route::post('{solicitud}/rechazar', [SolicitudCompetenciaController::class, 'rechazar'])->name('coordinador.rechazar');
});

/*
|--------------------------------------------------------------------------
| Tipos de Ambiente
|--------------------------------------------------------------------------
*/
Route::resources([
    'tipo-ambientes' => TipoAmbienteController::class,
], [
    'parameters' => [
        'tipo-ambientes' => 'tipoAmbiente',
    ],
]);
