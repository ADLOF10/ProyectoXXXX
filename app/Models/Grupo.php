<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';    

    protected $fillable = [
        'nombre_grupo', 
        'materia', 
        'profesor', 
        'clave',
    ];

    public function grupoAlumnoo()
    {
        return $this->hasMany(GrupoAlumno::class,'clave_id');
    }

    ////asistencia
    public function asisten()
    {
        return $this->hasMany(Asistencia::class,'grupo_id');
    }


        public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'grupoalumno', 'clave_id', 'alumno_id', 'clave', 'id');
    }


}
