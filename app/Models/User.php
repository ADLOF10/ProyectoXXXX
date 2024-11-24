<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail; // Notificación personalizada

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tipo'
    ];

    /**
     * Los atributos que deben estar ocultos para los arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Personalización del envío de la notificación de verificación de correo.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail); // Usa tu notificación personalizada
    }

    /**
     * Ejemplo de relación (opcional).
     * Relación con el modelo Alumno si aplica.
     */
    public function alumno()
    {
        return $this->hasOne(Alumno::class);
    }

    /**
     * Relación con el modelo Profesor si aplica.
     */
    public function profesor()
    {
        return $this->hasOne(Profesor::class);
    }
}
