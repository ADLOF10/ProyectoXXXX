<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Academico;
use App\Mail\AprobacionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SuperUsuarioController extends Controller
{
    /**
     * Muestra la vista de aprobaciones con las listas de alumnos y académicos.
     */
    public function mostrarDashboard()
    {
        // $alumnos = User::where('es_academico', 0)->get(); // 0 para alumnos
        // $academicos = User::where('es_academico', 1)->get(); // 1 para académicos
    
        // return view('dashsuper', compact('alumnos', 'academicos'));

        return view('dashsuper');
    }
    

    

    /**
     * Aprueba un usuario y genera sus credenciales institucionales.
     */
    public function aprobarUsuario($id)
    {
        $usuario = User::findOrFail($id);

        // Generar correo institucional y número de cuenta.
        $usuario->correo_institucional = $this->generarCorreoInstitucional($usuario);
        $usuario->numero_cuenta = $this->generarNumeroCuenta($usuario);
        $usuario->password = bcrypt($usuario->numero_cuenta); // Contraseña inicial será el número de cuenta.
        $usuario->save();

        // Enviar correo al usuario con sus credenciales.
        Mail::to($usuario->correo_personal)->send(new AprobacionMail($usuario));

        return redirect()->route('aprobaciones')->with('success', 'Usuario aprobado correctamente y credenciales enviadas.');
    }

    /**
     * Rechaza un usuario y elimina su registro.
     */
    public function rechazarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('aprobaciones')->with('success', 'Usuario rechazado y eliminado correctamente.');
    }

    /**
     * Genera un correo institucional basado en las reglas definidas.
     */
    private function generarCorreoInstitucional(User $usuario)
    {
        $primerLetraNombre = substr($usuario->nombre, 0, 1);
        $apellidoCompleto = strtolower(str_replace(' ', '', $usuario->apellidos));
        $cuatroUltimosID = substr($usuario->id, -4);
        $terminacion = $usuario->es_academico ? 'academico.universidad.mx' : 'alumno.universidad.mx';

        return $primerLetraNombre . $apellidoCompleto . $cuatroUltimosID . '@' . $terminacion;
    }

    /**
     * Genera un número de cuenta basado en las reglas definidas.
     */
    private function generarNumeroCuenta(User $usuario)
    {
        // Determinar los últimos 2 dígitos del centro universitario.
        $centros = [
            'Unidad academica profesional tiangistenco' => '21',
            'Ciudad universitaria' => '22',
        ];
        $centroUniversitario = $centros[$usuario->centro_universitario] ?? '00';

        // Determinar los primeros 2 dígitos de la licenciatura.
        $licenciaturas = [
            'Software' => '11',
            'Plasticos' => '12',
            'Computacion' => '13',
            'Arquitectura' => '14',
            'Derecho' => '15',
        ];
        $licenciatura = $licenciaturas[$usuario->licenciatura] ?? '00';

        // Generar un identificador único de 3 dígitos basado en el ID del usuario.
        $idUnico = str_pad($usuario->id, 3, '0', STR_PAD_LEFT);

        return $centroUniversitario . $licenciatura . $idUnico;
    }

        public function aprobarAcademico(Request $request, $id)
    {
        // Encontrar al académico en la tabla `users`
        $usuario = User::findOrFail($id);

        // Generar correo institucional y número de cuenta
        $correoInstitucional = strtolower(substr($usuario->nombre, 0, 1)) .
            strtolower($usuario->apellidos) .
            '@academico.universidad.mx';

        $numeroCuenta = '22' . '11' . str_pad($usuario->id, 3, '0', STR_PAD_LEFT);

        // Crear un académico en la tabla `academicos`
        Academico::create([
            'nombre' => $usuario->nombre,
            'apellidos' => $usuario->apellidos,
            'correo_institucional' => $correoInstitucional,
            'numero_cuenta' => $numeroCuenta,
            'centro_universitario' => $usuario->centro_universitario,
            'licenciaturas' => json_encode(['Software', 'Derecho']), // Esto puedes adaptarlo según tu lógica
            'grupos' => json_encode(['Grupo A', 'Grupo B']),
            'cedula_profesional' => $usuario->cedula_profesional,
            'password' => bcrypt($numeroCuenta),
        ]);

        // Eliminar al usuario de la tabla `users`
        $usuario->delete();

        // Enviar correo con credenciales
        Mail::to($usuario->correo_personal)->send(new AprobacionMail([
            'correo_institucional' => $correoInstitucional,
            'numero_cuenta' => $numeroCuenta,
        ]));

        return redirect()->route('aprobaciones')->with('success', 'Académico aprobado correctamente.');
    }

}
