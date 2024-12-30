<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        // Puedes inicializar datos aquí si es necesario
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Especifica los canales de notificación
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Generar el enlace de verificación
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifica tu correo electrónico')
            ->greeting('Hola!')
            ->line('Gracias por registrarte en nuestra aplicación. Por favor, verifica tu correo electrónico haciendo clic en el botón de abajo.')
            ->action('Verificar correo electrónico', $verificationUrl)
            ->line('Si no te registraste, no es necesario realizar ninguna acción.')
            ->salutation('Saludos, El equipo de soporte.');
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param mixed $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return url(route('verification.verify', [
            'id' => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ], false));
    }
}
