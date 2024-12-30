<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factor;

class SolicitudRegistro extends Model
{
    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno', 'correo_personal',
        'tipo_usuario', 'centro_educativo', 'licenciatura', 'fecha_nacimiento',
        'telefono', 'domicilio', 'estado'
    ];
}
