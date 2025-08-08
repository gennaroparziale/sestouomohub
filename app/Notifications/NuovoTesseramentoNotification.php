<?php

namespace App\Notifications;

use App\Models\Tesseramento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuovoTesseramentoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Tesseramento $tesseramento
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        // Per ora, salviamo la notifica solo nel database.
        // In futuro potremmo aggiungere 'mail' per inviare anche un'email!
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        // Questi sono i dati che verranno salvati in formato JSON nel database
        return [
            'message' => $this->tesseramento->user->name . ' ' . $this->tesseramento->user->cognome . ' ha pagato la tessera!',
            'tesseramento_id' => $this->tesseramento->id,
            'user_id' => $this->tesseramento->user->id,
            'link' => route('admin.tesseramenti.index') // Un link utile per l'admin
        ];
    }
}
