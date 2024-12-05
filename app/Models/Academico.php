<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academico extends Model
{
    use HasFactory;

    protected $table = 'academicos';

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo_institucional',
        'numero_cuenta',
        'centro_universitario',
        'licenciatura',
        'grupo',
        'cedula_profesional',
        'password',
    ];

    // Convertir licenciaturas y grupos a JSON automáticamente
    
}
