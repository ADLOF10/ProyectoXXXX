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
     * Create a new message instance.
     *
     * @param $usuario
     */
    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.aprobacion')
            ->subject('Tu registro ha sido aprobado')
            ->with([
                'nombre' => $this->usuario->nombre,
                'correoInstitucional' => $this->usuario->correo_institucional,
                'numeroCuenta' => $this->usuario->numero_cuenta,
            ]);
    }
}
