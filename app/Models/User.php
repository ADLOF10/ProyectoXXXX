<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'genero',
        'correo_personal',
        'correo_institucional', // Campo para login
        'numero_cuenta',        // Contraseña inicial
        'licenciatura',
        'centro_universitario',
        'cedula_profesional',
        'es_academico',
        'role',                 // Rol del usuario
    ];

    /**
     * Campos ocultos para arrays.
     */
    protected $hidden = [
        'numero_cuenta',        // Contraseña
        'remember_token',
    ];

    /**
     * Casts para los datos.
     */
    protected $casts = [
        'es_academico' => 'boolean',
        'fecha_nacimiento' => 'date',
    ];

    /**
     * Cambia el identificador para autenticación a `correo_institucional`.
     */
    public function getAuthIdentifierName()
    {
        return 'correo_institucional';
    }

    /**
     * Verifica si el usuario tiene un rol específico.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Relación con la solicitud.
     */
    public function solicitud()
    {
        return $this->hasOne(Solicitud::class);
    }

    /**
     * Verifica si el usuario es un superusuario.
     */
    public function isSuperUsuario(): bool
    {
        return $this->role === 'superusuario';
    }

    /**
     * Verifica si el usuario es académico.
     */
    public function isAcademico(): bool
    {
        return $this->role === 'academico';
    }

    /**
     * Verifica si el usuario es alumno.
     */
    public function isAlumno(): bool
    {
        return $this->role === 'alumno';
    }
}
