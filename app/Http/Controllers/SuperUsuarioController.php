<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SuperUsuarioController extends Controller
{
    /**
     * Mostrar usuarios pendientes de aprobación.
     */
    public function listarSolicitudes()
    {
        // Filtrar usuarios que no han sido aprobados aún
        $users = User::whereNull('role')->get();
        return view('aprobaciones', compact('users'));
    }

    /**
     * Aprobar un usuario y asignar un rol.
     */
    public function aprobarRegistro(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:alumno,academico',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('listarSolicitudes')->with('success', 'Usuario aprobado con el rol de ' . ucfirst($request->role) . '.');
    }

    /**
     * Rechazar y eliminar un usuario pendiente.
     */
    public function rechazarRegistro($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('listarSolicitudes')->with('success', 'Usuario rechazado y eliminado correctamente.');
    }
}
