<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsAppChannel
{

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);
        $to = $notifiable->routeNotificationFor('WhatsApp');
        $from = config('twilio.from');

        $twilio = new Client(config('twilio.account_sid'), config('twilio.auth_token'));

        ds($to, $message->contentSid, $message->variables);


        if ($message->contentSid) {
            return $twilio->messages->create(
                'whatsapp:' . $to,
                [
                    "from" => 'whatsapp:' . $from,
                    "contentSid" => $message->contentSid,
                    "contentVariables" => $message->variables
                ]
            );
        }


        return $twilio->messages->create(
            'whatsapp:' . $to,
            [
                'from' => "whatsapp:" . $from,
                'body' => $message->content
            ]
        );
    }
}
        //HXf94f4e5f4a2cbc8f59b38db0e3911c27    sem variavel
        //HX86f676f6ad047277c9d7f067760c67a6    com link da stripe