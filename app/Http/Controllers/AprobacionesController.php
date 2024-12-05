<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AprobacionMail;

class AprobacionesController extends Controller
{
    public function index()
    {
        $alumnos = Solicitud::where('es_academico', false)->where('estatus', 'pendiente')->get();
        $academicos = Solicitud::where('es_academico', true)->where('estatus', 'pendiente')->get();
        return view('dashsuper', compact('alumnos', 'academicos'));
    }

    public function aprobar($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        // Generar correo institucional y número de cuenta
        $correoInstitucional = strtolower(substr($solicitud->nombre, 0, 1) . $solicitud->apellidos . '@' . ($solicitud->es_academico ? 'academico.universidad.mx' : 'alumno.universidad.mx'));
        $numeroCuenta = substr($solicitud->centro_universitario, -2) . substr($solicitud->licenciatura, 0, 2) . str_pad($solicitud->id, 3, '0', STR_PAD_LEFT);

        // Crear usuario
        User::create([
            'nombre' => $solicitud->nombre,
            'apellidos' => $solicitud->apellidos,
            'fecha_nacimiento' => $solicitud->fecha_nacimiento,
            'genero' => $solicitud->genero,
            'correo_personal' => $solicitud->correo_personal,
            'licenciatura' => $solicitud->licenciatura,
            'centro_universitario' => $solicitud->centro_universitario,
            'cedula_profesional' => $solicitud->cedula_profesional,
            'correo_institucional' => $correoInstitucional,
            'numero_cuenta' => $numeroCuenta,
            'es_academico' => $solicitud->es_academico,
            'password' => bcrypt($numeroCuenta),
        ]);

        // Marcar solicitud como aprobada
        $solicitud->update(['estatus' => 'aprobado']);

        // Enviar correo
        Mail::to($solicitud->correo_personal)->send(new AprobacionMail($correoInstitucional, $numeroCuenta));

        return redirect()->back()->with('success', 'Solicitud aprobada exitosamente.');
    }

    public function rechazar($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update(['estatus' => 'rechazado']);
        return redirect()->back()->with('success', 'Solicitud rechazada.');
    }
}
