<?php

namespace App\Service;

use App\Models\User;
use App\Notifications\MenuNotification;
use App\Notifications\ScheduleListNotification;

class ConversationalService
{

    protected User $user;

    protected $client;

    protected array $commands = [
        "!menu" => "showMenu",
        "!agenda" => "showSchedule",
        "!insights" => "showInsights",
        "!update" =>  "updateUserTask"
    ];

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function handleIncomingMessage($data)
    {

        $message = $data["Body"];

        if (array_key_exists(strtolower($message), $this->commands)) {
            $handler = $this->commands[strtolower($message)];

            return $this->{$handler}();
        }
    }


    public function showMenu(): void
    {
        $this->user->notify(new MenuNotification);
    }

    public function showSchedule(): void
    {
        $tasks = $this->user->tasks()->where("due_at", ">", now())->orderBy("due_at")->get();

        $this->user->notify(new ScheduleListNotification($tasks, $this->user->name));
    }
}
