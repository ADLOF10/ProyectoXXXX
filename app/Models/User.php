<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
// implements MustVerifyEmail
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'genero',
        'correo_personal',
        'licenciatura',
        'centro_universitario',
        'cedula_profesional',
        'es_academico',
        'role', // Campo para manejar roles
    ];

    /**
     * Atributos ocultos para arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Casts para tipos de datos.
     *
     * @var array
     */
    protected $casts = [
        'es_academico' => 'boolean',
        'fecha_nacimiento' => 'date',
    ];

    /**
     * Verifica si el usuario tiene un rol específico.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Verifica si el usuario es un superusuario.
     *
     * @return bool
     */
    public function isSuperUsuario(): bool
    {
        return $this->role === 'superusuario';
    }

    /**
     * Verifica si el usuario es académico.
     *
     * @return bool
     */
    public function isAcademico(): bool
    {
        return $this->role === 'academico';
    }

    /**
     * Verifica si el usuario es alumno.
     *
     * @return bool
     */
    public function isAlumno(): bool
    {
        return $this->role === 'alumno';
    }
}
