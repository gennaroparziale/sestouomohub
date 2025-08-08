<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NuovoUtenteRegistratoNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotificaAdminNuovoUtente
{
    public function __construct()
    {
        //
    }

    public function handle(Registered $event): void
    {
        $admins = User::where('is_admin', true)->get();
        $nuovoUtente = $event->user;

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NuovoUtenteRegistratoNotification($nuovoUtente));
        }
    }
}
