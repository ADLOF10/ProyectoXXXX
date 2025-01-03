<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoAlumno extends Model
{

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
