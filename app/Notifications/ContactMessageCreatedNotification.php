<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMessageCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly ContactMessage $contactMessage
    ) {}

    public function via(object $notifiable): array
    {
        return [
            'mail',
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nova mensagem de contato - Lume')
            ->greeting('Nova mensagem recebida')
            ->line("Nome: {$this->contactMessage->name}")
            ->line("E-mail: {$this->contactMessage->email}")
            ->line("Assunto: {$this->contactMessage->subject}")
            ->line('Mensagem:')
            ->line($this->contactMessage->message);
    }
}
