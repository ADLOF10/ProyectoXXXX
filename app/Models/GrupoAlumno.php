<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAlumno extends Model

{
    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'clave_id',
    ];

    

    public function grupoo()
    {
        return $this->belongsTo(Grupo::class,'clave');
    }

    public function alumnoo()
    {
        return $this->belongsTo(Alumno::class,'id');
    }
    //
}
