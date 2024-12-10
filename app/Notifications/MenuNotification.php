<?php

namespace App\Notifications;

use App\Notifications\Channels\WhatsAppChannel;
use App\Notifications\Channels\WhatsAppMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MenuNotification extends Notification
{
    use Queueable;

    private string $message = "Aqui estão os comandos que você pode usar:
    !menu -> Abrir menu
    !agenda -> Agenda
    !insights -> Insights
    !update -> Update

    Escolhe ai
    ";

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toWhatsApp(object $notifiable)
    {
        return (new WhatsAppMessage)->content($this->message);
    }
}
