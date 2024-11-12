<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id', 
        'alumno_id', 
        'fecha', 
        'hora', 
        'estado'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
