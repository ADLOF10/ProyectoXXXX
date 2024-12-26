<?php

use App\Http\Controllers\grupos\GruposController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NuevoRegistroController;
use App\Http\Controllers\grupos\RegistroController as GruposRegistroController;
use App\Http\Controllers\SuperUsuarioController;
use App\Http\Controllers\AcademicoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/generador-qr', function () {
    return view('welcome');
});

Route::get('/asistencias', function () {
    return view('asistencias.consulta');
});


Route::get('', function () {
    return view('home');
})->name('inicio');


Route::middleware('role:superusuario')->group(function () {
    Route::get('/aprobaciones', [SuperUsuarioController::class, 'index'])->name('aprobaciones');
    Route::post('/aprobaciones/{id}/aprobar', [SuperUsuarioController::class, 'aprobar'])->name('aprobaciones.aprobar');
    Route::post('/aprobaciones/{id}/rechazar', [SuperUsuarioController::class, 'rechazar'])->name('aprobaciones.rechazar');
});


Route::get('/registro-usuario', [NuevoRegistroController::class, 'showForm'])->name('registro.usuario');
Route::post('/registro-usuario', [NuevoRegistroController::class, 'handleForm'])->name('registro.usuario.handle');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login2', [LoginController::class, 'handleLogin'])->name('login.handle');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas para dashboards según roles 
Route::get('/dashboard/alumno', function () {
    return view('dashalumno');
})->name('dashboard.alumno');

Route::get('/dashboard/profesor', function () {
    return view('dashmaestro');
})->name('dashboard.profesor');

Route::get('/dashboard/superuser', function () {
    return view('dashsuper');
})->name('dashboard.superuser');

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');

Route::get('/aprovaciones', function () {
    return view('asistencias.aprobaciones');
})->name('apro');

Route::get('/assis', function () {
    return view('asistencias.assitencias');
})->name('asiste');

Route::get('/con', function () {
    return view('asistencias.consulta');
})->name('con');

//nuevos dashboard para los usuarios
Route::get('/dashboard/pofe',function(){
    return view('ventanapofe');
})->name('dash.pofe');

Route::get('/dashboard/alum',function(){
    return view('ventanaalum');
})->name('dash.alum');

Route::get('/dashboard/super',function(){
    return view('ventanasuper');
})->name('dash.super');

//////

////crud de grupo
Route::get('/dashboard/crudgrupo',function(){
    return view('crudgrupo');
})->name('dash.crudgrupo');

Route::post('/guardar_gru', [GruposController::class, 'registarGru'])->name('guardarGru');



//////
///////crud para alumno
Route::get('/dashboard/crudalumno',function(){
    return view('crudalumno');
})->name('dash.crudalumno');




Route::get('/aprobaciones', [SuperUsuarioController::class, 'listarSolicitudes'])->name('aprobaciones');


// Ruta para mostrar el formulario de registro de grupo
//Route::get('/registro-grupo', [GruposController::class, 'mostrarFormularioRegistro'])->name('registroGrupo');

// Ruta para la vista de asistencias
// Route::get('/asistencias', [GruposController::class, 'consultaAsistencias']);


// Ruta para mostrar el formulario de registro de grupo
Route::get('/registro-grupo', [GruposController::class, 'mostrarFormularioRegistro'])->name('registroGrupo');

// Ruta para guardar el grupo (envío de formulario)///////////////////////////////////////
Route::post('guardar-grupo', [GruposController::class, 'guardarGrupo'])->name('guardarGrupo');  //trabajando

// Ruta para la consulta de asistencias
// Route::get('/consulta-asistencias', [GruposController::class, 'consultaAsistencias'])->name('consultaAsistencias');

// Ruta para la vista de alumnos (lista de alumnos)
Route::get('/alumnos', [GruposController::class, 'tablaAlumos'])->name('tablaAlumos');

// Ruta para buscar alumnos (usando AJAX en la vista de alumnos)
Route::get('/buscar-alumnos', [GruposController::class, 'buscarAlumos'])->name('buscarAlumos');

// Ruta para eliminar un alumno
Route::delete('/eliminar-alumno/{cuenta}', [GruposController::class, 'eliminarAlumno'])->name('eliminarAlumno');

// Ruta para ver y editar los datos de un alumno específico
Route::get('/editar-alumno/{cuenta}', [GruposController::class, 'datosAlumno'])->name('editarAlumno');

// Ruta para consultar el administrador
Route::get('/admin', [GruposController::class, 'consultaAdmin'])->name('consultaAdmin');

// Ruta para editar un administrador
Route::post('/editar-admin/{id}', [GruposController::class, 'editarAdmin'])->name('editarAdmin');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
