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


            'password' => [
            'required',
            'string',
            'min:8', // Longitud mínima
            'regex:/[A-Z]/', // Al menos una letra mayúscula
            'regex:/[a-z]/', // Al menos una letra minúscula
            'regex:/[0-9]/', // Al menos un número

        ],
       
    
        [
            
            'nombre.required_if' => 'Campo Obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener caracteres',
            'apellidos.required_if' => 'Campo Obligatorio.',
            'apellidos.regex' => 'El apellido solo puede contener caracteres',
            'password.required_if' =>'Campo Obligatorio',
            'password.regex'=> 'La contraseña debe de tener al menos 8 caracteres una mayuscula una minuscula y un numero',
        ],
        ]);


        // Creación del usuario
        User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'correo_personal' => (string) $request->input('correo_personal'),
            'correo_institucional' => (string) $request->input('correo_institucional'),
            'cedula_profesional' => $request->input('cedula_profesional'), // Será null si no aplica
            'es_academico' => $request->has('es_academico'), // Retorna true si el checkbox fue marcado
            'password' => bcrypt($request->input('password')),
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
