<?php

namespace App\Listeners;

use App\Events\NuovaSottoscrizioneTessera;
use App\Models\User;
use App\Notifications\NuovaSottoscrizioneNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotificaAdminNuovaSottoscrizione
{
    public function __construct()
    {
        //
    }

    public function handle(NuovaSottoscrizioneTessera $event): void
    {
        $admins = User::where('is_admin', true)->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NuovaSottoscrizioneNotification($event->tesseramento));
        }
    }
}
