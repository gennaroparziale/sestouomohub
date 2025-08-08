<?php

namespace App\Notifications;

use App\Models\PrenotazioneTrasferta;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NuovaPrenotazioneTrasfertaNotification extends Notification
{
    use Queueable;

    public function __construct(
        public PrenotazioneTrasferta $prenotazione
    ) {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $this->prenotazione->loadMissing(['user', 'trasferta']);
        $utente = $this->prenotazione->user;
        $trasferta = $this->prenotazione->trasferta;

        return [
            'message' => $utente->name . ' ' . $utente->cognome . ' ha prenotato per la trasferta contro ' . $trasferta->avversario . '.',
            'link' => route('admin.trasferte.prenotazioni', $trasferta),
        ];
    }
}
