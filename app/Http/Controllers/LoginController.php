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
        $request->validate([
            'correo_institucional' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->input('correo_institucional'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (str_contains($user->email, '@alumno.universidad.mx')) {
                return redirect()->route('dashboard.alumno');
            } elseif (str_contains($user->email, '@academico.universidad.mx')) {
                return redirect()->route('dashboard.academico');
            } elseif ($user->email === 'dios@gmail.com') {
                return redirect()->route('dashboard.superusuario');
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
