<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asistencia;

class GraficaControlador extends Controller
{
    

    public function showAttendanceChart()
    {
        $data = DB::table('asistencias')
            ->select('alumno_id', 'estado', DB::raw('COUNT(*) as count'))
            ->groupBy('alumno_id', 'estado')
            ->get();
    
        $formattedData = $data->groupBy('alumno_id')->map(function ($items) {
            $total = $items->sum('count');
            return [
                'asistencias' => $items->where('estado', 'asistencia')->sum('count') / $total * 100,
                'retardos' => $items->where('estado', 'retardo')->sum('count') / $total * 100,
                'faltas' => $items->where('estado', 'falta')->sum('count') / $total * 100,
            ];
        });
    
        return view('asistencia_alum', ['data' => $formattedData]);
    }
    
}
