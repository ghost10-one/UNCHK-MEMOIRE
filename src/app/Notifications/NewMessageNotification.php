<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Message $message) {}

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouveau message : ' . $this->message->subject)
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Vous avez reçu un nouveau message de ' . $this->message->sender->name)
            ->line('Sujet : ' . $this->message->subject)
            ->action('Lire le message', route('messages.show', $this->message))
            ->line('Plateforme Délégués Médicaux');
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message_id'  => $this->message->id,
            'subject'     => $this->message->subject,
            'sender_name' => $this->message->sender->name,
            'url'         => route('messages.show', $this->message),
        ];
    }
}