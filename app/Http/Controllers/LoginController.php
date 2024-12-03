<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function handleLogin(Request $request)
    {
        //print_r('hola');
        //die;

        $request->validate([
            'correo_institucional' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'correo_institucional' => $request->input('correo_institucional'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

              // Redirige según el tipo de usuario
            if (str_contains($user->correo_institucional, '@alumno.universidad.mx') && !$user->es_academico) {
                return redirect()->route('dashboard.alumno');
            } elseif (str_contains($user->correo_institucional, '@academico.universidad.mx') && $user->es_academico) {
                return redirect()->route('dashboard.academico');
            } elseif ($user->correo_personal === 'dios@gmail.com') {
                return redirect()->route('dashsuper'); // Ruta del superusuario
            }
        }

        return back()->withErrors(['login_error' => 'Correo o contraseña incorrectos.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
