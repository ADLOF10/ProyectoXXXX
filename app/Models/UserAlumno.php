<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAlumno extends Model
{

    protected $fillable = [
        'alumno_id', 
        'clave_id', 
    ];

    public function userr()
    {
        return $this->belongsTo(User::class,'correo_institucional');
    }

    public function Alumnoo()
    {
        return $this->belongsTo(Alumno::class,'correo_institucional');
    }

}
