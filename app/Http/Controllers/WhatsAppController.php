<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\newUserNotification;
use App\Service\StripeService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Stripe\Stripe;

class WhatsAppController extends Controller
{
    public function __construct(protected UserService $userService, protected StripeService $stripe) {}

    public function newMessage(Request $request): void
    {

        $phone = "+" . $request->post("WaId");

        $user = User::where("phone", $phone)->first();

        // dsd($user);

        if (!$user) {
            $this->userService->store($request->all());
        }


        if (!$user->subscribed()) {
            $this->stripe->payment($user);
        }


        $user->notify(new newUserNotification($user->name));
    }
}
