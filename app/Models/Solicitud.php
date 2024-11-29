<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Solicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'es_aprobado',
    ];

    /**
     * Relación con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
