<?php

namespace App\Http\Controllers\grupos;

use App\Http\Controllers\Controller; // Importar la clase base del controlador
use Illuminate\Http\Request; // Importar la clase Request
use App\Models\SolicitudRegistro; // Importar el modelo SolicitudRegistro

class RegistroController extends Controller // Definir correctamente la clase
{
    public function solicitarRegistro(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            // (Otras validaciones)
        ]);

        SolicitudRegistro::create($request->all());

        return redirect()->back()->with('status', 'Solicitud enviada con éxito.');
    }
}
