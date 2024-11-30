<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        'correo_institucional',
        'numero_cuenta',
        'licenciatura',
        'centro_universitario',
        'cedula_profesional',
        'es_academico',
        'role', // Campo para manejar roles
        'password', // Campo de contraseña
    ];

    /**
     * Atributos ocultos para arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * Devuelve el nombre del atributo usado para la autenticación.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'correo_personal';
    }

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
     * Relación con la solicitud.
     */
    public function solicitud()
    {
        return $this->hasOne(Solicitud::class);
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
