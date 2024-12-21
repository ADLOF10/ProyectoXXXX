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
            'correo_personal' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'correo_personal' => $request->input('correo_personal'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

              // Redirige según el tipo de usuario
            if ($user->correo_personal === 'dios@gmail.com') {
                return redirect()->route('dashboard.superuser'); // Redirección para el superusuario
            } elseif ($user->es_academico) {
                return redirect()->route('dashboard.profesor'); // Redirección para profesor
            } elseif (!$user->es_academico) {
                return redirect()->route('dashboard.alumno'); // Redirección para alumno
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
