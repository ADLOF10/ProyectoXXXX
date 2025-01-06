<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'correo_personal' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('correo_personal', 'password');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard'); // Redirigir al dashboard si las credenciales son correctas
        }

        // Si las credenciales son incorrectas, regresar con un mensaje de error
        return back()->withErrors([
            'correo_personal' => 'El correo o la contraseña son incorrectos.',
        ])->onlyInput('correo_personal');
    }

    
    public function showLoginForm()
    {
        return view('login');
    }

    public function handleLogin(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'correo_personal' => 'required|email',
            'password' => 'required',
        ]);

        // Obtener las credenciales
        $credentials = $request->only('correo_personal', 'password');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Redirigir al dashboard si la autenticación es exitosa
            return redirect()->intended('dashboard');
        }

        // Regresar al formulario con un mensaje de error
        return back()->withErrors([
            'correo_personal' => 'El correo o la contraseña son incorrectos.',
        ])->onlyInput('correo_personal');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
