<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AprobacionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Datos del usuario que será aprobado.
     *
     * @var mixed
     */
    public $usuario;

    /**
     * Crear una nueva instancia de mensaje.
     *
     * @param mixed $usuario
     */
    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Construir el mensaje.
     *
     * @return $this
     */
    public function build()
    {
        // Ajusta el asunto y la vista para el correo.
        return $this
            ->subject('Credenciales Institucionales')
            ->view('emails.aprobacion') // Asegúrate de tener esta vista creada.
            ->with([
                'correoInstitucional' => $this->usuario->correo_institucional,
                'numeroCuenta' => $this->usuario->numero_cuenta,
                'nombreCompleto' => $this->usuario->nombre . ' ' . $this->usuario->apellidos,
            ]);
    }
}
