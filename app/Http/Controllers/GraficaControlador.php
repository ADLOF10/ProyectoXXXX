<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Auth;

class GraficaControlador extends Controller
{
    
    ///grafica para alumno

    public function showAttendanceChart(Request $request)
    {
       
        $userName = Auth::user()->nombre;
       
                // Validar datos del formulario
                $request->validate([
                    'grupo' => 'required|string',
                ]);
    
                $grupo = $request->input('grupo');
                $alumno = $userName;
    
                // Consultar datos agrupados
                $data = DB::table('asistencias')
                    ->join('users', 'asistencias.alumno_id', '=', 'users.id')
                    ->join('grupos', 'asistencias.grupo_id', '=', 'grupos.id')
                    ->select(
                        'asistencias.estado',
                        DB::raw('COUNT(*) as count')
                    )
                    ->where('users.nombre', $alumno)
                    ->where('grupos.nombre_grupo', $grupo)
                    ->groupBy('asistencias.estado')
                    ->get();
    
                // Calcular totales y porcentajes
                $total = $data->sum('count');
                $percentages = [
                    'asistencias' => $data->where('estado', 'asistencia')->sum('count') / $total * 100,
                    'retardos' => $data->where('estado', 'retardo')->sum('count') / $total * 100,
                    'faltas' => $data->where('estado', 'falta')->sum('count') / $total * 100,
                ];
    
                // Devolver la vista con los datos
                return view('asistencia_alum', [
                    'percentages' => $percentages,
                    'grupo' => $grupo,
                    'alumno' => $alumno,
                ]);
    }
    

    //grafica para profesor 

    public function grafiprofe(Request $request)
    {
       
                // Validar datos del formulario
            $request->validate([
                'grupo' => 'required|string',
                'alumno' => 'required|string',
            ]);

            $grupo = $request->input('grupo');
            $alumno = $request->input('alumno');

            // Consultar datos agrupados
            $data = DB::table('asistencias')
                ->join('users', 'asistencias.alumno_id', '=', 'users.id')
                ->join('grupos', 'asistencias.grupo_id', '=', 'grupos.id')
                ->select(
                    'asistencias.estado',
                    DB::raw('COUNT(*) as count')
                )
                ->where('users.nombre', $alumno)
                ->where('grupos.nombre_grupo', $grupo)
                ->groupBy('asistencias.estado')
                ->get();

            // Calcular totales y porcentajes
            $total = $data->sum('count');
            $percentages = [
                'asistencias' => $data->where('estado', 'asistencia')->sum('count') / $total * 100,
                'retardos' => $data->where('estado', 'retardo')->sum('count') / $total * 100,
                'faltas' => $data->where('estado', 'falta')->sum('count') / $total * 100,
            ];

            // Devolver la vista con los datos
            return view('asistencia_profe', [
                'percentages' => $percentages,
                'grupo' => $grupo,
                'alumno' => $alumno,
            ]);
   }


}
