<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'correo_institucional',
        'numero_cuenta',
        'grupo',
        'semestre',
        'carrera',
        'password',
    ];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
