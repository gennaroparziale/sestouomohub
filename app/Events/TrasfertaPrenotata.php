<?php

namespace App\Events;

use App\Models\PrenotazioneTrasferta;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrasfertaPrenotata
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public PrenotazioneTrasferta $prenotazione
    ) {
        //
    }
}
