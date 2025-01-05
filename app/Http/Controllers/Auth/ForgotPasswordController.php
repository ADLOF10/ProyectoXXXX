<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // Mostrar el formulario de recuperación de contraseña
    public function showLinkRequestForm()
    {
        return view('forgot-password');
    }

    // Procesar la solicitud de envío del enlace de recuperación
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'correo_personal' => 'required|email|exists:users,correo_personal',
        ]);

        // Generar un token único y almacenarlo en caché
        $user = User::where('correo_personal', $request->correo_personal)->first();
        $token = bin2hex(random_bytes(16));

        Cache::put("password_reset_{$user->correo_personal}", $token, now()->addMinutes(30));

        // Enviar el enlace por correo electrónico
        Mail::send('emails.reset-password', ['token' => $token], function ($message) use ($user) {
            $message->to($user->correo_personal)
                    ->subject('Restablecimiento de Contraseña');
        });

        return back()->with('status', 'Se ha enviado un enlace de recuperación a tu correo.');
    }

    // Mostrar el formulario para restablecer la contraseña
    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    // Procesar el restablecimiento de contraseña
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'correo_personal' => 'required|email|exists:users,correo_personal',
            'password' => 'required|min:8|confirmed',
        ]);

        // Verificar el token almacenado en caché
        $cachedToken = Cache::get("password_reset_{$request->correo_personal}");

        if (!$cachedToken || $cachedToken !== $request->token) {
            return back()->withErrors(['correo_personal' => 'El token de recuperación es inválido o ha expirado.']);
        }

        // Actualizar la contraseña del usuario
        $user = User::where('correo_personal', $request->correo_personal)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Eliminar el token de caché
        Cache::forget("password_reset_{$request->correo_personal}");

        return redirect()->route('login')->with('status', 'Tu contraseña ha sido restablecida correctamente.');
    }
}
