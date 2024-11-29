<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class NuevoRegistroController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function showForm()
    {
        return view('nuevoregistro'); // Asegúrate de que esta vista existe.
    }

    /**
     * Maneja el envío del formulario de registro.
     */
    public function handleForm(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:10',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u', // Solo caracteres alfabéticos y espacios
            ],
            'apellidos' => [
                'required',
                'string',
                'max:40',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u', // Solo caracteres alfabéticos y espacios
            ],

            'fecha_nacimiento' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $age = \Carbon\Carbon::parse($value)->age;
                    if ($age < 17) {
                        $fail('La edad debe ser de al menos 17 años.');
                    }
                },
            ],

            'genero' => 'required|string',
            'correo_personal' => [
                'required',
                'email',
                'unique:users,correo_personal',
                function ($attribute, $value, $fail) {
                    if ($value !== strtolower($value)) {
                        $fail('El correo personal solo puede contener letras minúsculas.');
                    }
                },
            ],
            'licenciatura' => 'required|string|max:30',
            'centro_universitario' => 'required|string|max:30',
            'cedula_profesional' => [
                'nullable', // Puede ser nula si no es académico
                'required_if:es_academico,on', // Obligatoria si es académico
                'regex:/^\d{7,8}$/', // Solo números de 7 u 8 dígitos
            ],
        ], [
            'cedula_profesional.required_if' => 'La cédula profesional es obligatoria para académicos.',
            'cedula_profesional.regex' => 'La cédula profesional debe ser un número de 7 u 8 dígitos.',
            'nombre.required_if' => 'Campo Obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener caracteres',
            'apellidos.required_if' => 'Campo Obligatorio.',
            'apellidos.regex' => 'El apellido solo puede contener caracteres',
        ]);


        // Creación del usuario
        User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'genero' => $request->input('genero'),
            'correo_personal' => $request->input('correo_personal'),
            'licenciatura' => $request->input('licenciatura'),
            'centro_universitario' => $request->input('centro_universitario'),
            'cedula_profesional' => $request->input('cedula_profesional'), // Será null si no aplica
            'es_academico' => $request->has('es_academico'), // Retorna true si el checkbox fue marcado
        ]);


        // User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'role' => $data['role'],
        // ]);

        // Redirige con un mensaje de éxito
        return redirect()->back()->with('success', 'Usuario registrado correctamente.');
    }
}
