<?php

use App\Http\Controllers\grupos\GruposController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NuevoRegistroController;
use App\Http\Controllers\grupos\RegistroController as GruposRegistroController;
use App\Http\Controllers\SuperUsuarioController;
use App\Http\Controllers\AcademicoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LoginController;

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/generador-qr', function () {
    return view('welcome');
});

Route::get('', function () {
    return view('home');
});


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
})->name('dashboard.alumno')->middleware('auth');

Route::get('/dashboard/profesor', function () {
    return view('dashmaestro');
})->name('dashboard.profesor')->middleware('auth');

Route::get('/dashboard/superusuario', function () {
    return view('dashsuper');
})->name('dashboard.superusuario')->middleware('auth');


Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');


Route::get('/aprobaciones', [SuperUsuarioController::class, 'listarSolicitudes'])->name('aprobaciones');

Route::middleware(['auth', 'role:superusuario'])->group(function () {
    Route::get('/dashsuper', [SuperUsuarioController::class, 'mostrarDashboard'])->name('dashboard');
    Route::get('/aprobaciones', [SuperUsuarioController::class, 'mostrarAprobaciones'])->name('aprobaciones');
});




// use App\Http\Controllers\AuthController;

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['role:superusuario'])->group(function () {
//     Route::get('/dashboard/superusuario', function () {
//         return view('dashboard.superusuario');
//     })->name('dashboard.superusuario');
// });

// Route::middleware(['role:academico'])->group(function () {
//     Route::get('/dashboard/academico', function () {
//         return view('dashboard.academico');
//     })->name('dashboard.academico');
// });

// Route::middleware(['role:alumno'])->group(function () {
//     Route::get('/dashboard/alumno', function () {
//         return view('dashboard.alumno');
//     })->name('dashboard.alumno');
// });



// Route::middleware(['auth', 'role:superusuario'])->group(function () {
//     Route::get('/aprobaciones', [SuperUsuarioController::class, 'listarSolicitudes'])->name('listarSolicitudes');
//     Route::post('/aprobar/{id}', [SuperUsuarioController::class, 'aprobarRegistro'])->name('aprobarRegistro');
//     Route::delete('/rechazar/{id}', [SuperUsuarioController::class, 'rechazarRegistro'])->name('rechazarRegistro');
// });


// Route::middleware(['auth', 'role:superusuario'])->group(function () {
//     Route::get('/aprobaciones', [SuperUsuarioController::class, 'index']);
// });



// // Superusuario
// Route::middleware(['auth', 'role:superusuario'])->group(function () {
//     Route::get('/aprobaciones', [SuperUsuarioController::class, 'index']);
//     Route::post('/aprobar', [SuperUsuarioController::class, 'aprobarUsuario']);
// });

// // Académicos
// Route::middleware(['auth', 'role:academico'])->group(function () {
//     Route::get('/crear-qr', [AcademicoController::class, 'crearQR']);
//     Route::get('/consulta-alumnos', [AcademicoController::class, 'consultaAlumnos']);
// });

// // Alumnos
// Route::middleware(['auth', 'role:alumno'])->group(function () {
//     Route::get('/asistencias', [AlumnoController::class, 'verAsistencias']);
//     Route::get('/historial', [AlumnoController::class, 'historial']);
// });


// Ruta para mostrar el formulario de registro de grupo
Route::get('/registro-grupo', [GruposController::class, 'mostrarFormularioRegistro'])->name('registroGrupo');

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
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
