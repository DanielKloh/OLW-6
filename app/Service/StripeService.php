<?php

namespace App\Service;

use App\Models\User;
use App\Notifications\NewUserNotification;

class StripeService
{


    public function payment($user)
    {

        $result = $user->checkout(
            'price_1QNOaeKTCbBt4EJCl4IE8ebh',
            [
                "phone_number_collection" => ["enabled" => true],
                "mode" => "subscription",
                "success_url" => "https://wa.me/" . str_replace("+", "", config("twilio.from")),
                "cancel_url" => "https://wa.me/" . str_replace("+", "", config("twilio.from")),
            ],
        )->toArray();

        $user->notify(new NewUserNotification($user->name));

        return $result;
    }
}