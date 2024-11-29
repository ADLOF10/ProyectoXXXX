<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'profesores';

    // Columnas que se pueden asignar en masa
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo_institucional',
        'telefono',
        'departamento',
        'fecha_nacimiento',
        'genero',
    ];

    // Tipos de datos para las columnas
    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    /**
     * Relación con la tabla de grupos.
     * Un profesor puede tener varios grupos asignados.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    /**
     * Relación con asistencias (si aplica).
     * Un profesor puede registrar muchas asistencias.
     */
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
