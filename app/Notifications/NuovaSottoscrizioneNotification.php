<?php

namespace App\Notifications;

use App\Models\Tesseramento;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NuovaSottoscrizioneNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Tesseramento $tesseramento
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
            'message' => $this->tesseramento->user->name . ' si è iscritto alla tessera ' . $this->tesseramento->tipoTessera->nome,
            'link' => route('admin.tesseramenti.index'),
        ];
    }
}
