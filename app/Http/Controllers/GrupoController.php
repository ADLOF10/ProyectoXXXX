<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grupo;
use App\Models\Alumno;

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
        // Obtener el grupo con los alumnos relacionados
        $grupo = DB::table('grupos')->where('id', $grupoId)->first();

        if (!$grupo) {
            return back()->with('error', 'El grupo no existe.');
        }

        // Obtener los alumnos asociados al grupo
        $alumnos = DB::table('alumnos')
            ->where('grupo_id', $grupoId)
            ->get();

        return view('crudgrupo', compact('grupo', 'alumnos'));
    }

    public function showAlumnos($id)
    {
        // Consultar los alumnos del grupo seleccionado
        $alumnos = DB::table('alumnos')
            ->join('grupos', 'alumnos.grupo_id', '=', 'grupos.id')
            ->select(
                'alumnos.nombre',
                'alumnos.apellidos',
                'alumnos.correo_institucional',
                'alumnos.numero_cuenta',
                'alumnos.semestre',
                'alumnos.licenciatura',
                'grupos.nombre_grupo'
            )
            ->where('grupos.id', $id) // Filtrar por el ID del grupo
            ->get();

        // Retornar la vista con los alumnos
        return view('grupo_alumnos', compact('alumnos'));

    }

        public function consulAlum()
        {

            $alumnos = Alumno::paginate(10);
            return view('grupo_alumnos', compact('alumnos'));
        }

}
