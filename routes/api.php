<?php

use App\Http\Controllers\WhatsAppController;
use App\Http\Middleware\TwilioRequestMiddleware;
use Illuminate\Support\Facades\Route;

Route::post("/new_message",[WhatsAppController::class, "newMessage"])->middleware(TwilioRequestMiddleware::class)->name("newMessage");