<?php

namespace App\Listeners;

use App\Events\PrenotazionePagata;
use App\Models\CategoriaSpesa;
use App\Models\Transazione;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreaTransazionePerPrenotazione
{
    public function __construct()
    {
        //
    }

    public function handle(PrenotazionePagata $event): void
    {
        $prenotazione = $event->prenotazione->loadMissing(['user', 'trasferta']);
        $utente = $prenotazione->user;
        $trasferta = $prenotazione->trasferta;

        $categoria = CategoriaSpesa::firstOrCreate(
            ['nome' => 'Costi Trasferte'], // Cerca questa
            ['nome' => 'Costi Trasferte']  // Se non c'è, la crea così
        );

        Transazione::create([
            'data_transazione' => now(),
            'descrizione' => 'Pagamento quota trasferta vs ' . $trasferta->avversario . ' - ' . $utente->name . ' ' . $utente->cognome,
            'importo' => $trasferta->costo,
            'tipo' => 'entrata',
            'categoria_spesa_id' => $categoria->id,
            'metodo_pagamento' => 'Contanti', // Assumiamo contanti per il pagamento manuale
        ]);
    }
}
