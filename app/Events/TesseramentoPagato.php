<?php

namespace App\Events;

use App\Models\Tesseramento;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TesseramentoPagato
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Tesseramento $tesseramento
    ) {
        //
    }
}
