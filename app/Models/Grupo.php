<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;


    protected $fillable = [
        'nombre_grupo', 
        'materia', 
        'fecha_clase', 
        'profesor', 
        'horario_clase', 
        'horario_clase_final', 
        'horario_registro', 
        'qr_code',
        'alumno_id',
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

}
