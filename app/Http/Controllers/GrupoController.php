<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grupo;
use App\Models\Alumno;
use Illuminate\Support\Facades\Auth;

class GrupoController extends Controller
{

        public function index()
    {
        // Consultar todos los grupos y contar sus alumnos
        $grupos = DB::table('grupos')
            ->leftJoin('alumnos', 'grupos.id', '=', 'alumnos.grupo_id')
            ->select(
                'grupos.id',
                'grupos.clave',
                'grupos.nombre_grupo',
                'grupos.materia',
                'grupos.profesor',
                DB::raw('COUNT(alumnos.id) as total_alumnos') // Contar los alumnos en cada grupo
            )
            ->groupBy('grupos.id', 'grupos.clave', 'grupos.nombre_grupo', 'grupos.materia', 'grupos.profesor')
            ->get();

        // Retornar la vista con los datos de los grupos
        return view('crudgrupo', compact('grupos'));
    }


    public function mostrarAlumnosGrupo($grupoId)
    {
        // Obtener el grupo por ID
        $grupo = Grupo::findOrFail($grupoId);
    
        // Obtener los alumnos relacionados con el grupo usando la tabla `grupoalumno`
        $alumnos = DB::table('grupoAlumno')
            ->join('alumnos', 'grupoAlumno.alumno_id', '=', 'alumnos.id')
            ->join('grupos', 'grupoAlumno.clave_id', '=', 'grupos.clave')
            ->where('grupos.id', $grupoId)
            ->select('alumnos.nombre', 'alumnos.apellidos', 'alumnos.numero_cuenta')
            ->get();
    
        // Retornar la vista con los datos
        return view('grupo_alumnos', compact('grupo', 'alumnos'));
    }
    

    public function showAlumnos($id)
    {

        $grupo = Grupo::findOrFail($id);

        // Usar la relación definida en el modelo para obtener los alumnos
        $alumnos = $grupo->alumnos;

        return view('grupo_alumnos', compact('grupo', 'alumnos'));
    
        // // Consultar los alumnos del grupo seleccionado
        // $alumnos = DB::table('alumnos')
        //     ->join('grupos', 'alumnos.grupo_id', '=', 'grupos.id')
        //     ->select(
        //         'alumnos.nombre',
        //         'alumnos.apellidos',
        //         'alumnos.correo_institucional',
        //         'alumnos.numero_cuenta',
        //         'alumnos.semestre',
        //         'alumnos.licenciatura',
        //         'grupos.nombre_grupo'
        //     )
        //     ->where('grupos.id', $id) // Filtrar por el ID del grupo
        //     ->get();

        // // Retornar la vista con los alumnos
        // return view('grupo_alumnos', compact('alumnos'));

    }

        public function consulAlum($id)
        {
            
            $userName = Auth::user()->nombre;

            $alumnos =DB::table('grupoAlumno')
                    ->join('alumnos', 'grupoAlumno.alumno_id', '=', 'alumnos.id') // Relaciona con alumnos
                    ->join('grupos', 'grupoAlumno.clave_id', '=', 'grupos.clave') // Relaciona con grupos
                    ->where('grupos.profesor', '=', $userName) // Filtro por correo
                    ->where('grupos.clave', '=', $id)
                    ->select('grupoAlumno.*', 'alumnos.nombre as alumno_nombre', 'grupos.nombre_grupo', 'grupos.materia', 'grupos.profesor') // Selecciona columnas necesarias
                    ->get();

           // $alumnos = Alumno::paginate(10);
            return view('grupo_alumnos', compact('alumnos','userName'));
        }

}
