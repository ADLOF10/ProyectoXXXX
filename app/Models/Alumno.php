<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo_institucional',
        'numero_cuenta',
        'semestre',
        'licenciatura',
    ];

    public function userAlumnoo()
    {
        return $this->belongsTo(UserAlumno::class,'correo_institucional_alumno');
    }

        public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    // Relación con el modelo User
    public function user()
    {
        return $this->hasOne(User::class, 'correo_personal', 'correo_institucional');
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'grupoAlumno', 'alumno_id', 'clave_id', 'id', 'clave');
    }
    

}
