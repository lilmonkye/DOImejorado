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
    public $role;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($estatus)
    {
        //
        $this->estatus = $estatus;
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
        ->subject('Cambio de estatus de solicitud')
        ->greeting('Buen día')
        ->line('El estatus de tu solicitud ha cambiado.')
        ->line('Nuevo estatus: '.$this->estatus)
        ->line('Gracias por utilizar nuestra plataforma.');
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
