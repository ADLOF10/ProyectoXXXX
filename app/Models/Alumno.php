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

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function userss()
    {
        return $this->belongsTo(User::class,'correo_instituciona');
    }

    public function grupoo()
    {
        return $this->belongsTo(Grupo::class,'alumno_id');
    }
}
