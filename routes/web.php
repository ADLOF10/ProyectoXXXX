<?php

use App\Http\Controllers\grupos\GruposController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para mostrar el formulario de registro de grupo
Route::get('/registro', [GruposController::class, 'mostrarFormularioRegistro']);

// Ruta para la vista de asistencias
Route::get('/asistencias', [GruposController::class, 'consultaAsistencias']);


// Ruta para mostrar el formulario de registro de grupo
Route::get('/registro-grupo', [GruposController::class, 'mostrarFormularioRegistro'])->name('registroGrupo');

// Ruta para guardar el grupo (envío de formulario)
Route::post('guardar-grupo', [GruposController::class, 'guardarGrupo'])->name('guardarGrupo');  //trabajando 

// Ruta para la consulta de asistencias
Route::get('/consulta-asistencias', [GruposController::class, 'consultaAsistencias'])->name('consultaAsistencias');

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