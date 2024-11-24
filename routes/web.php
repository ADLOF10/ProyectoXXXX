<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\grupos\GruposController;
use App\Http\Controllers\grupos\RegistroController;
use App\Http\Controllers\grupos\SuperUsuarioController;
use App\Http\Controllers\EscaneoQrController;
use App\Http\Controllers\HistorialAsistenciasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Ruta principal para todos los usuarios
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Registro de usuarios
Route::get('/registro', [RegistroController::class, 'show'])->name('registro');
Route::post('/registro', [RegistroController::class, 'solicitarRegistro'])->name('solicitarRegistro');

// Superusuario: manejo de aprobaciones
Route::middleware(['auth', 'superusuario'])->group(function () {
    Route::get('/aprobaciones', [SuperUsuarioController::class, 'listarSolicitudes'])->name('listarSolicitudes');
    Route::post('/aprobar/{id}', [SuperUsuarioController::class, 'aprobarRegistro'])->name('aprobarRegistro');
    Route::delete('/rechazar/{id}', [SuperUsuarioController::class, 'rechazarRegistro'])->name('rechazarRegistro');
});

// Inicio de sesión y autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard y rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Verificación de correo electrónico
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Se envió un enlace de verificación a tu correo.');
    })->middleware('throttle:6,1')->name('verification.send');
});

// Rutas para profesores y alumnos
Route::middleware(['auth', 'verified'])->group(function () {
    // Profesores
    Route::middleware(['role:profesor'])->group(function () {
        Route::get('/registro-grupo', [GruposController::class, 'mostrarFormularioRegistro'])->name('registroGrupo');
        Route::post('/guardar-grupo', [GruposController::class, 'guardarGrupo'])->name('guardarGrupo');
        Route::get('/consulta-asistencias', [GruposController::class, 'consultaAsistencias'])->name('consultaAsistencias');
    });

    // Alumnos
    Route::middleware(['role:alumno'])->group(function () {
        Route::get('/asistencias', [GruposController::class, 'consultaAsistencias'])->name('asistenciasAlumno');
    });
});

// Administrador y superusuario
Route::middleware(['auth', 'superusuario'])->group(function () {
    Route::get('/admin', [GruposController::class, 'consultaAdmin'])->name('consultaAdmin');
    Route::post('/editar-admin/{id}', [GruposController::class, 'editarAdmin'])->name('editarAdmin');
});

// Otras rutas relacionadas con alumnos
Route::middleware(['auth', 'role:profesor'])->group(function () {
    Route::get('/alumnos', [GruposController::class, 'tablaAlumos'])->name('tablaAlumos');
    Route::get('/buscar-alumnos', [GruposController::class, 'buscarAlumos'])->name('buscarAlumos');
    Route::delete('/eliminar-alumno/{cuenta}', [GruposController::class, 'eliminarAlumno'])->name('eliminarAlumno');
    Route::get('/editar-alumno/{cuenta}', [GruposController::class, 'datosAlumno'])->name('editarAlumno');
});




// Rutas protegidas para profesores
Route::middleware(['auth', 'role:profesor'])->group(function () {
    Route::get('/registro-grupo', [GruposController::class, 'mostrarFormularioRegistro'])->name('registroGrupo');
    Route::get('/consulta-asistencias', [GruposController::class, 'consultaAsistencias'])->name('consultaAsistencias');
});

// Rutas protegidas para alumnos
Route::middleware(['auth', 'role:alumno'])->group(function () {
    Route::get('/escaneo-qr', [EscaneoQrController::class, 'show'])->name('escaneoQr');
    Route::get('/historial-asistencias', [HistorialAsistenciasController::class, 'show'])->name('historialAsistencias');
});

// Ruta para que los profesores vean el historial de asistencias
Route::get('/historial-asistencias', [HistorialAsistenciasController::class, 'mostrarHistorial'])
    ->middleware(['auth', 'role:profesor'])
    ->name('historialAsistencias');

// Ruta para que los alumnos vean su propio historial
Route::get('/mi-historial', [HistorialAsistenciasController::class, 'mostrarHistorialAlumno'])
    ->middleware(['auth', 'role:alumno'])
    ->name('miHistorial');



// Ruta para registro de grupos (Profesores)
Route::get('/registro-grupo', [GruposController::class, 'mostrarFormularioRegistro'])->name('registroGrupo');
Route::post('/guardar-grupo', [GruposController::class, 'guardarGrupo'])->name('guardarGrupo');

// Ruta para escaneo QR (Alumnos)
Route::get('/escaneo-qr', [EscaneoQrController::class, 'show'])->name('escaneoQr');
Route::post('/escaneo-qr', [EscaneoQrController::class, 'registrarAsistencia'])->name('registrarAsistencia');

// Ruta para la vista del escaneo del QR
Route::get('/escaneo-qr', [EscaneoQrController::class, 'mostrarEscaneo'])->middleware(['auth', 'verified'])->name('escaneoQr');

// Ruta para procesar el escaneo del QR
Route::post('/procesar-qr', [EscaneoQrController::class, 'procesarQr'])->middleware(['auth', 'verified'])->name('procesarQr');

// Ruta para historial de asistencias (Alumnos)
Route::get('/historial-asistencias', [HistorialAsistenciasController::class, 'show'])->name('historialAsistencias');






// Ruta para mostrar el formulario de registro de grupo
Route::get('/registro', [GruposController::class, 'mostrarFormularioRegistro']);

// Ruta para la vista de asistencias
Route::get('/asistencias', [GruposController::class, 'consultaAsistencias']);


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