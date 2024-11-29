<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

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
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required|string',
        'correo_personal' => 'required|email|unique:users,correo_personal',
        'licenciatura' => 'required|string|max:255',
        'centro_universitario' => 'required|string|max:255',
        'cedula_profesional' => 'nullable|string|max:20|required_if:es_academico,on',
    ]);

    // Generar una contraseña aleatoria
    $password = bcrypt(Str::random(8));

    // Crear el usuario con la contraseña generada
    User::create([
        'nombre' => $request->input('nombre'),
        'apellidos' => $request->input('apellidos'),
        'fecha_nacimiento' => $request->input('fecha_nacimiento'),
        'genero' => $request->input('genero'),
        'correo_personal' => $request->input('correo_personal'),
        'licenciatura' => $request->input('licenciatura'),
        'centro_universitario' => $request->input('centro_universitario'),
        'cedula_profesional' => $request->input('cedula_profesional'),
        'es_academico' => $request->has('es_academico'),
        'password' => $password,
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