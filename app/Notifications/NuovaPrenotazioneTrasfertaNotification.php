<?php

namespace App\Notifications;

use App\Models\PrenotazioneTrasferta;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NuovaPrenotazioneTrasfertaNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public function __construct(
        public PrenotazioneTrasferta $prenotazione
    ) {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
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
    public function broadcastOn(): array
    {
        // Usiamo un canale privato, così solo gli admin possono ascoltare
        return [new \Illuminate\Broadcasting\PrivateChannel('admins')];
    }
    public function toArray(object $notifiable): array
    {
        // Riutilizziamo gli stessi dati che salviamo nel database.
        return $this->toDatabase($notifiable);
    }
}
