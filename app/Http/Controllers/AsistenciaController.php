<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function consultaAsistencias(Request $request)
    {
        // Recupera la fecha seleccionada del calendario (si está presente)
        $fechaSeleccionada = $request->input('fecha', Carbon::now()->toDateString());
    
        // Recupera los grupos con sus asistencias filtradas por la fecha seleccionada
        $grupos = Grupo::with(['asistencias' => function($query) use ($fechaSeleccionada) {
            $query->whereDate('fecha', $fechaSeleccionada);  // Filtra las asistencias por la fecha seleccionada
        }, 'asistencias.alumno'])->get();
    
        // Lista para almacenar los resultados con el porcentaje de asistencia calculado
        $resultados = [];
    
        // Itera sobre los grupos
        foreach ($grupos as $grupo) {
            // Total de asistencias para el grupo (solo se cuentan los registros filtrados por fecha)
            $totalDias = $grupo->asistencias->count();
    
            // Agrupamos las asistencias por alumno para calcular el porcentaje individualmente
            $asistenciasPorAlumno = $grupo->asistencias->groupBy('alumno_id');
    
            // Itera sobre los alumnos y sus asistencias
            foreach ($asistenciasPorAlumno as $alumnoId => $asistencias) {
                // Contamos los días asistidos por el alumno (estado 'asistio')
                $diasAsistidos = $asistencias->where('estado', 'asistio')->count();
    
                // Calculamos el porcentaje de asistencia
                $porcentajeAsistencia = $totalDias > 0 ? ($diasAsistidos / $totalDias) * 100 : 0;
    
                // Añadimos los datos al arreglo de resultados
                $resultados[] = [
                    'alumno_id' => $alumnoId,
                    'nombre_alumno' => $asistencias->first()->alumno->nombre,  // Obtener nombre del alumno
                    'grupo' => $grupo->nombre_grupo,
                    'materia' => $grupo->materia,
                    'porcentaje_asistencia' => $porcentajeAsistencia,
                ];
            }
        }
    
        // Pasamos los resultados y la fecha seleccionada a la vista
        return view('asistencias.consulta', compact('resultados', 'fechaSeleccionada'));
    }
}

