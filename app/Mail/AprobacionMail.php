<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AprobacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;

    /**
     * Crea una nueva instancia del mensaje.
     *
     * @param \App\Models\User $usuario
     */
    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Construye el mensaje.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Credenciales de Acceso Institucionales')
                    ->view('emails.aprobacion')
                    ->with([
                        'nombre' => $this->usuario->nombre,
                        'correoInstitucional' => $this->usuario->correo_institucional,
                        'numeroCuenta' => $this->usuario->numero_cuenta,
                    ]);
    }
}
