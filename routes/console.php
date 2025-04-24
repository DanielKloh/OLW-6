<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


if (app()->environment('local')) {
    DB::purge('mysql');
    config([
        'database.connections.mysql.host' => env('DB_HOST', 'mysql'),
        'database.connections.mysql.database' => env('DB_DATABASE', 'laravel'),
        'database.connections.mysql.username' => env('DB_USERNAME', 'root'),
        'database.connections.mysql.password' => env('DB_PASSWORD', ''),
    ]);
    DB::reconnect('mysql');
}

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('send:reminder', function () {
    $tasks = \App\Models\Task::with('user')->where('reminder_at', now())->get();

    foreach ($tasks as $task) {

        if ($task->user->last_whatsapp_at->diffInHours(now()) >= 24) {
            $task->user->notify(new \App\Notifications\ReminderNotification());
        } else {
            $message = "Lembrete de tarefa: {$task->description}";
            $task->user->notify(new \App\Notifications\GenericNotification($message));
        }

    }
})->everyMinute();