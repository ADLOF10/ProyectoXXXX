<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EscaneoQrController extends Controller
{
    public function show()
    {
        return view('escaneoQr'); // Vista para escanear QR
    }

    public function registrarAsistencia(Request $request)
    {
        // Aquí implementarías la lógica para registrar la asistencia después de escanear un QR
        $request->validate([
            'qr_code' => 'required|string',
        ]);

        // Simulación de registro de asistencia
        // Tu lógica real debería consultar la base de datos y registrar el evento.
        return back()->with('message', 'Asistencia registrada exitosamente.');
    }
}
