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
        'grupo_id', // Clave foránea
    ];

    public function userAlumnoo()
    {
        return $this->belongsTo(UserAlumno::class,'correo_institucional_alumno');
    }

        public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }


}
