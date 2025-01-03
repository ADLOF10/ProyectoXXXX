<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
// implements MustVerifyEmail
{
    use HasFactory, Notifiable;

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
        'correo_institucional', // Nuevo campo para el correo institucional
        'numero_cuenta', // Nuevo campo para el número de cuenta
        'licenciatura',
        'centro_universitario',
        'cedula_profesional',
        'es_academico', // Campo para diferenciar entre académico y alumno
        'password',
        
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
     * Verifica si el usuario es académico.
     *
     * @return bool
     */
    public function isAcademico(): bool
    {
        return $this->es_academico === true;
    }

    /**
     * Verifica si el usuario es alumno.
     *
     * @return bool
     */
    public function isAlumno(): bool
    {
        return $this->es_academico === false;
    }

    /**
     * Relación con solicitudes (si aplicable).
     */
    public function solicitud()
    {
        return $this->hasOne(Solicitud::class);
    }

    /**
     * Relación con grupos (si aplica para académicos).
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'profesor_id');
    }

    /**
     * Relación con asistencias (si aplica para alumnos).
     */
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'alumno_id');
    }

    /**
     * Relación con licenciatura (si aplicas una tabla separada para licenciaturas en el futuro).
     */
    // public function licenciatura()
    // {
    //     return $this->belongsTo(Licenciatura::class, 'licenciatura_id');
    // }

    /**
     * Genera las credenciales institucionales para el usuario.
     *
     * @return void
     */
    public function generarCredenciales()
    {
        // Crear el correo institucional
        $inicialNombre = substr($this->nombre, 0, 1);
        $apellido = strtolower($this->apellidos);
        $id = str_pad(substr($this->id, -4), 4, '0', STR_PAD_LEFT);
        $terminacionCorreo = $this->isAcademico() ? 'academico.universidad.mx' : 'alumno.universidad.mx';
        $this->correo_institucional = "{$inicialNombre}{$apellido}{$id}@{$terminacionCorreo}";

        // Generar el número de cuenta
        $centro = substr($this->centro_universitario, -2);
        $licenciatura = substr($this->licenciatura, 0, 2);
        $numeroOrden = str_pad($this->id, 3, '0', STR_PAD_LEFT);
        $this->numero_cuenta = "{$centro}{$licenciatura}{$numeroOrden}";

        // Guardar los cambios
        $this->save();
    }


    public function alumnoo()
    {
        return $this->belongsTo(Alumno::class,'correo_instituciona');
    }

    public function asitenciass()
    {
        return $this->hasMany(Asistencia::class,'alumno_id');
    }



}
