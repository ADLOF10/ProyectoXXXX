<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Vista del formulario de login
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('correo_personal', $request->email)->first();

        if ($user && password_verify($request->password, $user->password)) {
            session(['user' => $user]);
            return redirect()->route('dashboard.' . $user->role);
        }

        return back()->withErrors(['email' => 'Credenciales inválidas.']);
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }
}
