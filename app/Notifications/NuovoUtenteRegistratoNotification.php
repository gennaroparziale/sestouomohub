<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NuovoUtenteRegistratoNotification extends Notification
{
    use Queueable;

    public function __construct(
        public User $nuovoUtente
    ) {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'Nuovo utente registrato: ' . $this->nuovoUtente->name . ' ' . $this->nuovoUtente->cognome,
            'link' => '#', // In futuro potremmo mettere un link alla sua anagrafica
            'user_id' => $this->nuovoUtente->id,
        ];
    }
}
