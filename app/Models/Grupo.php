<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupo';

    protected $fillable = [
        'nombre_grupo', 
        'materia', 
        'fecha_clase', 
        'profesor', 
        'horario_clase', 
        'horario_clase_final', 
        'horario_registro', 
        'qr_code',
    ];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

        public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
