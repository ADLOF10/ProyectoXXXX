<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistorialAsistenciasController extends Controller
{
    public function show()
    {
        // Aquí deberías obtener los datos de asistencia desde la base de datos
        $asistencias = []; // Simulación de datos
        return view('historialAsistencias', compact('asistencias'));
    }
}
