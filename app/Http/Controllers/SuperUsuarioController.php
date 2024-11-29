<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Mail;

class SuperUsuarioController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::with('user')->where('es_aprobado', false)->get();
        return view('aprobaciones', compact('solicitudes'));
    }

    public function aprobar($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $usuario = $solicitud->user;

        // Generar correo institucional
        $correoInstitucional = $this->generarCorreoInstitucional($usuario);

            // Generar correo institucional y número de cuenta
        $correoInstitucional = $this->generarCorreoInstitucional($usuario);
        $numeroCuenta = $this->generarNumeroCuenta($usuario);

        // Actualizar datos del usuario
        $usuario->update([
            'correo_institucional' => $correoInstitucional,
            'numero_cuenta' => $numeroCuenta,
        ]);

        // Marcar solicitud como aprobada
        $solicitud->update(['es_aprobado' => true]);

        // Enviar el correo
        Mail::to($usuario->correo_personal)->send(new AprobacionMail($usuario));

        return redirect()->route('aprobaciones')->with('success', 'Usuario aprobado y correo enviado.');
    }

    public function rechazar($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('aprobaciones')->with('success', 'Solicitud rechazada.');
    }

    private function generarCorreoInstitucional($usuario)
    {
        $nombreInicial = substr($usuario->nombre, 0, 1);
        $apellido = $usuario->apellidos;
        $apellidoInicial = substr(explode(' ', $usuario->apellidos)[1] ?? '', 0, 1);
        $registroId = str_pad($usuario->id, 4, '0', STR_PAD_LEFT);
        $terminacion = $usuario->es_academico ? 'academico.universidad.mx' : 'alumno.universidad.mx';

        return strtolower("$nombreInicial$apellido$apellidoInicial$registroId@$terminacion");
    }

    private function generarNumeroCuenta($usuario)
    {
        $centroMap = [
            'UAPT' => '21',
            'CU' => '22',
        ];

        $licenciaturaMap = [
            'Software' => '11',
            'Plasticos' => '12',
            'Computacion' => '13',
            'Arquitectura' => '14',
            'Derecho' => '15',
        ];

        $centro = $centroMap[$usuario->centro_universitario] ?? '00';
        $licenciatura = $licenciaturaMap[$usuario->licenciatura] ?? '00';
        $identificador = str_pad($usuario->id, 3, '0', STR_PAD_LEFT);

        return "$centro$licenciatura$identificador";
    }
}
