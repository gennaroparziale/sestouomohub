<?php

namespace App\Listeners;

use App\Events\TesseramentoPagato;
use App\Models\Transazione;
use App\Models\CategoriaSpesa;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\NuovoTesseramentoNotification;
use Illuminate\Support\Facades\Notification;

class CreaTransazionePerTesseramento
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TesseramentoPagato $event): void
    {
        $tesseramento = $event->tesseramento;

        // --- AZIONE 1: Creare la transazione (già esistente) ---
        $categoria = \App\Models\CategoriaSpesa::firstOrCreate(['nome' => 'Tesseramenti']);
        \App\Models\Transazione::create([
            'data_transazione' => now(),
            'descrizione' => 'Pagamento Tessera ' . $tesseramento->tipoTessera->nome . ' - ' . $tesseramento->user->name . ' ' . $tesseramento->user->cognome,
            'importo' => $tesseramento->tipoTessera->prezzo,
            'tipo' => 'entrata',
            'categoria_spesa_id' => $categoria->id,
            'metodo_pagamento' => $tesseramento->metodo_pagamento, // <-- NUOVA RIGA
        ]);

        // --- AZIONE 2: Inviare la notifica (la nostra novità!) ---

        // 1. Troviamo tutti gli utenti che sono amministratori
        $admins = User::where('is_admin', true)->get();

        // 2. Se esistono admin, inviamo la notifica a ognuno di loro
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NuovoTesseramentoNotification($tesseramento));
        }
    }
}
