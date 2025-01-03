<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'grupo_id',
        'fecha',
        'hora_registro',
        'estado',
        
    ];

    // Relación con alumno
    public function alumnou()
    {
        return $this->belongsTo(User::class,'id');
    }

    // Relación con grupo
    public function grupooo()
    {
        return $this->belongsTo(Grupo::class,'id');
    }
}
