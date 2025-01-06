<?php

use App\Http\Controllers\grupos\GruposController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NuevoRegistroController;
use App\Http\Controllers\grupos\RegistroController as GruposRegistroController;
use App\Http\Controllers\SuperUsuarioController;
use App\Http\Controllers\AcademicoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\GenerarqrController;
use App\Http\Controllers\GraficaControlador;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\QRScannerController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\Auth\ForgotPasswordController;




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




Route::get('/registro-usuario', [NuevoRegistroController::class, 'showForm'])->name('registro.usuario');
Route::post('/registro-usuario', [NuevoRegistroController::class, 'handleForm'])->name('registro.usuario.handle');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login2', [LoginController::class, 'handleLogin'])->name('login.handle');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



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

////crud de grupo del la vista profesor
Route::get('/dashboard/crudgrupo',function(){
    return view('crudgrupo');
})->name('dash.crudgrupo');

Route::get('/crear-grupo',function(){
    return view('crear_grupo');
})->name('crear-grupo');



Route::post('/guardar_gru', [GruposController::class, 'registarGru'])->name('guardarGru');
Route::get('/consultar_gru', [GruposController::class, 'consulGru'])->name('consultarGru');
Route::delete('/borrar_gru/{grupo}', [GruposController::class, 'destroy_profe'])->name('borrarGru');
///editar y actualizar
Route::get('grupos/{grupo}/edit', [GruposController::class, 'edit'])->name('grupos.edit');
Route::put('grupos/{grupo}', [GruposController::class, 'update'])->name('grupos.update');
//
Route::get('/ver_grupo', [GenerarqrController::class, 'verGrupo'])->name('verGrupo');
///crear qr de la ventana profrsor
Route::get('/crear_qr/{id}', [GenerarqrController::class, 'generate_qr'])->name('crearQr');
Route::post('/crear_qr/{id}', [GenerarqrController::class, 'generate_qr'])->name('crearQr');


// Ruta para listar los grupos
Route::get('/qr_profe', [GenerarqrController::class, 'verGrupo'])->name('verGrupo');

// Ruta para mostrar el formulario de configuración del QR
Route::get('/vista_qr/{id}', [GenerarqrController::class, 'verFormulario'])->name('vistaQr');

// Ruta para procesar el formulario y generar el QR
Route::post('/guardar_qr/{id}', [GenerarqrController::class, 'generate_qr'])->name('guardarQr');

Route::put('/editar_qr/{id}', [GenerarqrController::class, 'editarQr'])->name('editarQr');
Route::delete('/eliminar_qr/{id}', [GenerarqrController::class, 'eliminarQr'])->name('eliminarQr');

Route::post('/upload_alumnos', [AlumnoController::class, 'uploadAlumnos'])->name('uploadAlumnos');

Route::post('/alumnos/update/{index}', [AlumnoController::class, 'updateAlumno']);
Route::delete('/alumnos/delete/{index}', [AlumnoController::class, 'deleteAlumno']);

Route::post('/alumnos/store-all', [AlumnoController::class, 'storeAll'])->name('alumnos.storeAll');
Route::post('/alumnos/delete-duplicados', [AlumnoController::class, 'deleteDuplicados'])->name('alumnos.deleteDuplicados');
Route::post('/alumnos/upload', [AlumnoController::class, 'uploadAlumnos'])->name('uploadAlumnos');


Route::post('/alumnos/preview', [AlumnoController::class, 'previewAlumnos'])->name('previewAlumnos');
Route::post('/alumnos/upload', [AlumnoController::class, 'uploadAlumnos'])->name('uploadAlumnos');

Route::post('/grupos/{id}/alumnos', [GrupoController::class, 'addAlumno'])->name('grupo.addAlumno');
Route::post('/alumnos/manual', [AlumnoController::class, 'addManualAlumno'])->name('alumno.addManual');



// Mostrar el formulario de recuperación de contraseña
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Procesar la solicitud de envío del enlace de recuperación
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Mostrar el formulario para restablecer la contraseña
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

// Procesar el formulario para restablecer la contraseña
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');




// Ruta para mostrar alumnos con contraseñas
Route::get('/alumnos-con-password', [AlumnoController::class, 'getAlumnosConPassword'])->name('alumnos.con.password');





Route::post('/alumnos/store-all', [AlumnoController::class, 'storeAll'])->name('alumnos.storeAll');
Route::get('/grupos/{grupoId}/alumnos', [GrupoController::class, 'mostrarAlumnosGrupo'])->name('grupos.alumnos');



// Ruta para listar todos los grupos
Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');

// Ruta para mostrar los alumnos de un grupo específico
// Route::get('/grupos/{id}/alumnos', [GrupoController::class, 'showAlumnos'])->name('grupos.alumnos');
Route::get('/grupos/{id}/alumnos', [GrupoController::class, 'showAlumnos'])->name('grupo.alumnos');



Route::get('/grupos/{id}/alumnosalan', [GrupoController::class, 'consulAlum'])->name('grupos.alumnosalan');



////

/////apartado alumnos de la vista profesor
Route::get('/crudalumno-profe',function(){
    return view('crudalumno_profe');
})->name('crudalumno-profe');

////

/////apartado asistencias de la vista profesor
Route::get('/asistencia-profe',function(){
    return view('asistencia_profe');
})->name('asistencia-profe');

//////

/////apartado generar qr de la vista profesor
Route::get('/qr-profe',function(){
    return view('qr_profe');
})->name('qr-profe');

//////

Route::post('/generar-qr', [GenerarqrController::class, 'store'])->name('generar.qr');


///////crud para alumno de la vista alumno
Route::get('/dashboard/crudalumno',function(){
    return view('crudalumno');
})->name('dash.crudalumno');

Route::get('/consultar_gruAlum', [GruposController::class, 'consulGrualum'])->name('consultarGrual');

//escaner qr
Route::get('/app',function(){
    return view('app');
})->name('app_');
Route::get('/qr-scan', [QRScannerController::class, 'scanView'])->name('qr.scan');
Route::post('/store', [QRScannerController::class, 'store'])->name('store');



Route::get('/aprobaciones', [SuperUsuarioController::class, 'listarSolicitudes'])->name('aprobaciones');


///vista para la grafica de asistencias
Route::get('/asisten_grafi_alum',function(){
    return view('asistencia_alum');
})->name('asisten_grafi_alum');

Route::post('/attendance-chart', [GraficaControlador::class, 'showAttendanceChart'])->name('grafica_alum');

Route::post('/grafica-pro', [GraficaControlador::class, 'grafiprofe'])->name('attendance.filtered');


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
