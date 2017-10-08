<?php

namespace App\Notifications;

use App\Message;
use App\Support\IconNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MessageReceived extends Notification
{

    /**
     * The message model.
     *
     * @var Message
     */
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return filter_keys([
            'database' => true,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return (new IconNotification)
            ->icon('envelope')
            ->message('You received a new message!')
            ->toArray();
    }
}
