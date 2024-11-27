<?php

namespace App\Notifications;

use App\Notifications\Channels\WhatsAppChannel;
use App\Notifications\Channels\WhatsAppMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected string $name, protected string $stripeLink)
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

    public function toWhatsApp($notification)
    {
        //nova msg 
        //HX86f676f6ad047277c9d7f067760c67a6
        return (new WhatsAppMessage)
            ->contentSid("HX86f676f6ad047277c9d7f067760c67a6")
            ->variables([
                "1" => $this->name,
                "2" => $this->stripeLink
            ]);
    }
}
