<?php

namespace App\Http\Controllers\grupos;

use App\Http\Controllers\Controller;
use App\Models\SolicitudRegistro;
use Illuminate\Http\Request;

class SuperUsuarioController extends Controller
{
    /**
     * Listar solicitudes pendientes de aprobación.
     */
    public function listarSolicitudes()
    {
        $solicitudes = SolicitudRegistro::where('estado', 'pendiente')->get();
        return view('aprobaciones', compact('solicitudes'));
    }

    /**
     * Aprobar una solicitud de registro.
     */
    public function aprobarRegistro($id)
    {
        $solicitud = SolicitudRegistro::findOrFail($id);
        $solicitud->estado = 'aprobada';
        $solicitud->save();

        // Lógica para crear el usuario después de la aprobación
        // Por ejemplo:
        \App\Models\User::create([
            'name' => $solicitud->nombre,
            'email' => $solicitud->correo_institucional,
            'password' => bcrypt($solicitud->password),
            'tipo' => $solicitud->tipo,
        ]);

        return redirect()->route('listarSolicitudes')->with('status', 'Solicitud aprobada con éxito.');
    }

    /**
     * Rechazar una solicitud de registro.
     */
    public function rechazarRegistro($id)
    {
        $solicitud = SolicitudRegistro::findOrFail($id);
        $solicitud->estado = 'rechazada';
        $solicitud->save();

        return redirect()->route('listarSolicitudes')->with('status', 'Solicitud rechazada con éxito.');
    }
}
