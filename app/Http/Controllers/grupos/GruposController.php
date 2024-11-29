<?php

namespace App\Http\Controllers\grupos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grupo; // Modelo 'Grupo' para interactuar con la base de datos
use Carbon\Carbon;

class GruposController extends Controller
{
    // Método para mostrar el formulario de registro de grupo
    public function mostrarFormularioRegistro()
    {
        return view('registro.grupo'); // Asegúrate de que exista la vista en resources/views/registro/grupo.blade.php
    }

    public function guardarGrupo(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'nombreGrupo' => 'required|string|max:255|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'materia' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'fechaClase' => 'required|date|after_or_equal:today',    
            'profesor' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'horarioClase' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:19:00',
            'horarioClaseFinal' => 'required|date_format:H:i|after:horarioClase|before_or_equal:19:00',
            'horarioRegistro' => 'required|date_format:H:i', // se validará con lógica adicional
        ]);

        // Validación de rango de horario para horarioRegistro
        $horarioClase = $request->input('horarioClase');
        $horarioClaseFinal = $request->input('horarioClaseFinal');
        $horarioRegistro = $request->input('horarioRegistro');

        if ($horarioRegistro < $horarioClase || $horarioRegistro > $horarioClaseFinal) {
            return redirect()->back()->withErrors(['horarioRegistro' => 'El horario de registro debe estar entre el horario de inicio y finalización de la clase.']);
        }

        // Crear el registro en la base de datos si la validación se pasa
        Grupo::create([
            'nombre_grupo' => $request->input('nombreGrupo'),
            'materia' => $request->input('materia'),
            'fecha_clase' => $request->input('fechaClase'),
            'profesor' => $request->input('profesor'),
            'horario_clase' => $horarioClase,
            'horario_clase_final' => $horarioClaseFinal,
            'horario_registro' => $horarioRegistro,
            'qr_code' => 'GENERADO', // Aquí podrías generar el QR
        ]);

        //echo $horarioClase .  $request->input('nombreGrupo');

        return ;
    }

    // Método para la consulta de asistencias
    public function consultaAsistencias()
    {
        // Recupera los grupos y sus asistencias
        $grupos = Grupo::with('asistencias.alumno')->get();

        foreach ($grupos as $grupo) {
            foreach ($grupo->asistencias as $asistencia) {
                $totalDias = $grupo->asistencias->count();
                $diasAsistidos = $grupo->asistencias->where('estado', 'asistio')->count();
                $asistencia->porcentaje_asistencia = $totalDias > 0 ? ($diasAsistidos / $totalDias) * 100 : 0;
            }
        }

        return view('asistencias.consulta', compact('grupos'));
    }



    // Método para mostrar la lista de alumnos
    // public function tablaAlumos(Request $request)
    // {
    //     $id = $request->session()->get('id');
    //     $admin = Usuarios::find($id);
    //     $alumnos = Alumnos::where('id', 'like', '%'.$request->input('search').'%')->paginate(4);
    //     return view('administradores.alumnos.alumnos', compact('admin', 'alumnos'));
    // }






    //alumnos
    /*public function tablaAlumos(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);
        //$alumnos = Alumnos::get();
        $alumnos = Alumnos::where('id', 'like', '%'.$request->input('search').'%')->paginate(4);
        return view('administradores.alumnos.alumnos', compact('admin','alumnos'));
    }
    //buscar alumno
    public function buscarAlumos(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');
    
        $admin = Usuarios::find($id);
    
        // Obtén la consulta de búsqueda
        $search = $request->input('search');
    
        // Si hay un término de búsqueda, filtrar por él
        if ($search) 
        {
            $alumnos = Alumnos::where('no_cuenta', 'like', '%' . $search . '%')
                ->orWhere('nombre', 'like', '%' . $search . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $search . '%')
                ->paginate(4); // Paginación con 10 alumnos por página
        } 
        else 
        {
            $alumnos = Alumnos::paginate(4); // Paginación con 10 alumnos por página si no hay búsqueda
        }
        if ($request->ajax()) 
        {
            return response()->json($alumnos);
        }
    
        return view('administradores.alumnos.alumnos', compact('admin', 'alumnos'));
    }
    //eliminar alumno
    public function eliminarAlumno(Request $request,$cuenta)
    {
        
        // Buscar el alumno por su ID
        $alumno = Usuarios::where('no_cuenta', $cuenta)->first();

        // Verificar si el alumno existe
        if (!$alumno) {
            return redirect()->back()->with('status', 'El alumno no fue encontrado.')->with('error',false);
        }
        else
        {
            $alumno->delete();

            return redirect()->back()->with('status', 'Alumno eliminado con exito.')->with('error',true);
        }
    }
    //editar alumno
    public function datosAlumno(Request $request, $cuenta)
    {
        $id = $request->session()->get('id');

        $admin = Usuarios::find($id);
        $alumno = Alumnos::where('no_cuenta', $cuenta)->first();
        return view('administradores.alumnos.editarAlumno', compact('admin', 'alumno'));
    }




    
    //administrador
    public function consultaAdmin(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        if($rol == 'administrador')
        {
            //$alumnos = Alumno::with('credenciales')->get(); 
            $admin = Usuarios::find($id);
            return view('administradores.indexAdministrador', compact('admin'));
        }
        else if($rol !== 'administrador')
        {
            return redirect($ruta);
        }
        else
        {
            return redirect('index');
        }
    }

    public function editarAdmin(Request $request, $id)
    {
        //campos de entrada
        $nombre = $request->input('nombres');
        $paterno = $request->input('apellidoPaterno');
        $materno = $request->input('apellidoMaterno');
        $telefono = $request->input('telefono'); 
        //mensaje para los errores de los campos de texto 
        $alumnosController = new AlumnosController();
        $mensajeNombre = $alumnosController->validacionesTextos($nombre, "Nombre");
        $mensajePaterno = $alumnosController->validacionesTextos($paterno, "Apellido Paterno");
        $mensajeMaterno = $alumnosController->validacionesTextos($materno, "Apellido Materno");
        $mensajeTelefono = $alumnosController->validarNumero($telefono);

        if(!$mensajeNombre == "")
        {
            return back()->with('status', $mensajeNombre);
        }

        if(!$mensajePaterno == "")
        {
            return back()->with('status', $mensajePaterno);
        }

        if(!$mensajeMaterno == "")
        {
            return back()->with('status', $mensajeMaterno);
        }

        if(!$mensajeTelefono == "")
        {
            return back()->with('status', $mensajeTelefono);
        }

        //Verificamos si el teléfono ya existen para otro usuario
        $usuarioDuplicado = Usuarios::where('telefono', $telefono)
        ->where('id', '!=', $id)
        ->first();

        if ($usuarioDuplicado) 
        {
            $mensaje = '';
            
            if ($usuarioDuplicado->telefono == $telefono) 
            {
                $mensaje .= 'El número de teléfono ' . $telefono . ' ya está registrado.';
            }

            return back()->with('status', $mensaje)
            ->with('error',false)->withInput();
        }
        else
        {
            Usuarios::where('id', $id)->update([
                'nombre' => $nombre,
                'apellido_paterno' => $paterno,
                'apellido_materno' => $materno,
                'telefono' => $telefono,
            ]);

            return redirect('/index-admin')->with('status', 'Datos actualizado exitosamente.')
            ->with('error',true)->withInput();
        }
    }/*/
}
