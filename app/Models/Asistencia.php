<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_cuenta',
        'fecha',
        'hora_registro',
        'estado',
        'grupo_id',
        'alumno_id',
    ];

    // Relación con alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    // Relación con grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}
