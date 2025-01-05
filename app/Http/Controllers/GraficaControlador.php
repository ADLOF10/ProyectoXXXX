<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asistencia;
use App\Models\Grupo;
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
                $cek = Grupo::where('nombre_grupo', $grupo)->first();

                if ($cek) {

                $alumno = $userName;
                $existing= Alumno::where('nombre', $alumno)->first();
            if ($existing) {
    
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
            }else {
                return view('asistencia_alum');
                    
            }

            } else {// Crear el registro en la tabla UserAlumno
                return view('asistencia_alum');
                
    
                
        }

           
    }
    

    //grafica para profesor 

    public function grafiprofe(Request $request)
    {

        
            $request->validate([
                'grupo' => 'required|string',
                'alumno' => 'required|string',
            ]);

            $grupo = $request->input('grupo');

            $cek = Grupo::where('nombre_grupo', $grupo)->first();

            if ($cek) {
                // Verificar si ya existe un registro en la tabla UserAlumno
               
            $alumno = $request->input('alumno');
            $existing= Alumno::where('nombre', $alumno)->first();
            if ($existing) {

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
                }else {
                    return view('asistencia_profe');
                        
                }


            } else {// Crear el registro en la tabla UserAlumno
                return view('asistencia_profe');
                
    
                
        }

        
   }

   


}
