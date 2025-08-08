<?php

namespace App\Events;

use App\Models\Tesseramento;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NuovaSottoscrizioneTessera
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Tesseramento $tesseramento
    ) {
        //
    }
}
