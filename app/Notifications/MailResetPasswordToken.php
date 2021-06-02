<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailResetPasswordToken extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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

        $url = url($this->token);

        return (new MailMessage)
                    ->from('ipmedth.lakenhal@gmail.com', 'Museum De Lakenhal') // change address later to correct address
                    ->subject('Resetten Lakenhal Matcht wachtwoord')
                    ->greeting("Hallo!")
                    ->line('U ontvangt deze mail omdat u een aanvraag heeft gedaan om het wachtwoord te veranderen')
                    ->action('Reset wachtwoord', $url)
                    ->line('Als u dit niet was, hoeft u verder niks te doen.')
                    ->line('Bedankt voor het gebruiken van onze applicatie en hopelijk zien we u eens in ons museum!');
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
