<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\ConversationalService;
use App\Service\StripeService;
use App\Service\UserService;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function __construct(protected UserService $userService, protected StripeService $stripe, protected ConversationalService $conversationalService) {}

    public function newMessage(Request $request): void
    {
        $phone = $request->post("WaId");

        $user = User::where("phone", $phone)->first();
        
        if (!$user) {
            $user = $this->userService->store($request->all());
        }

        if (!$user->subscribed()) {
            $this->stripe->payment($user);
        }

        $user->last_whatsapp_at = now();
        $user->save();

        $this->conversationalService->setUser($user);
        $this->conversationalService->handleIncomingMessage($request->all());

    }
}
