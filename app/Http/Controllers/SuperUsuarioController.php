<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Mail\AprobacionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SuperUsuarioController extends Controller
{
    /**
     * Mostrar el dashboard del superusuario.
     */
    public function mostrarDashboard()
    {
        return view('dashsuper');
    }
    
    /**
     * Mostrar la lista de aprobaciones pendientes.
     */
    public function mostrarAprobaciones()
    {
        $solicitudes = Solicitud::where('es_aprobado', false)->get();
        return view('aprobaciones', compact('solicitudes'));
    }

    public function listarSolicitudes()
    {
        $solicitudes = User::whereNull('correo_institucional')->get();
        return view('aprobaciones', compact('solicitudes'));
    }

    /**
     * Aprobar una solicitud.
     */
    public function aprobar($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $usuario = $solicitud->user;

        // Generar correo institucional y número de cuenta
        $correoInstitucional = $this->generarCorreoInstitucional($usuario);
        $numeroCuenta = $this->generarNumeroCuenta($usuario);

        // Actualizar datos del usuario
        $usuario->update([
            'correo_institucional' => $correoInstitucional,
            'numero_cuenta' => $numeroCuenta,
        ]);

        $solicitud->update(['es_aprobado' => true]);

        // Enviar el correo
        Mail::to($usuario->correo_personal)->send(new AprobacionMail($usuario));

        return redirect()->route('aprobaciones')->with('success', 'Usuario aprobado y correo enviado.');
    }

    /**
     * Rechazar una solicitud.
     */
    public function rechazar($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        // Eliminar la solicitud
        $solicitud->delete();

        return redirect()->route('aprobaciones')->with('success', 'Solicitud rechazada correctamente.');
    }

    /**
     * Generar el correo institucional.
     */
    private function generarCorreoInstitucional($usuario)
    {
        $nombreInicial = strtoupper(substr($usuario->nombre, 0, 1));
        $apellidoCompleto = strtoupper($usuario->apellidos);
        $segundaInicial = strtoupper(substr($usuario->apellidos, strpos($usuario->apellidos, ' ') + 1, 1));
        $idFragment = substr($usuario->id, -4);
        $terminacion = $usuario->es_academico ? 'academico.universidad.mx' : 'alumno.universidad.mx';

        return "{$nombreInicial}{$apellidoCompleto}{$segundaInicial}{$idFragment}@{$terminacion}";
    }

    /**
     * Generar el número de cuenta.
     */
    private function generarNumeroCuenta($usuario)
    {
        // Mapeo del centro universitario y carrera
        $centros = [
            'UAPT' => '21',
            'CU' => '22',
        ];
        $carreras = [
            'Software' => '11',
            'Plasticos' => '12',
            'Computacion' => '13',
            'Arquitectura' => '14',
            'Derecho' => '15',
        ];

        $centroCode = $centros[$usuario->centro_universitario] ?? '00';
        $carreraCode = $carreras[$usuario->licenciatura] ?? '00';
        $registroCode = str_pad($usuario->id, 3, '0', STR_PAD_LEFT);

        return "{$centroCode}{$carreraCode}{$registroCode}";
    }
}
