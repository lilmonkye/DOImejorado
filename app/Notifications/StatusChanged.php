<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusChanged extends Notification
{
    use Queueable;
    public $estatus;
    public $email;
    public $idsolicitud;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($estatus,$email,$idsolicitud)
    {
        //
        $this->estatus = $estatus;
        $this->email = $email;
        $this->idsolicitud = $idsolicitud;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->subject('Cambio de estatus de solicitud')
        ->greeting('Buen día')
        ->line('El estatus de la solicitud No: ' .$this->idsolicitud. ' ha cambiado.')
        ->line('Nuevo estatus: '.$this->estatus)
        ->line('Gracias por utilizar nuestra plataforma.')
        ->salutation('Saludos');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
