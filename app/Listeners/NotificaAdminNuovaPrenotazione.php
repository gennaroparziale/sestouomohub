<?php

namespace App\Listeners;

use App\Events\TrasfertaPrenotata;
use App\Models\User;
use App\Notifications\NuovaPrenotazioneTrasfertaNotification;
use Illuminate\Support\Facades\Notification;

class NotificaAdminNuovaPrenotazione
{
    public function __construct()
    {
        //
    }

    public function handle(TrasfertaPrenotata $event): void
    {
        $admins = User::where('is_admin', true)->get();
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NuovaPrenotazioneTrasfertaNotification($event->prenotazione));
        }
    }
}
