<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAlumno extends Model
{
    protected $table = 'userAlumno';

    protected $fillable = [
        'correo_institucional_alumno', 
        'correo_institucional_user', 
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
