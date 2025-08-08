<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
// NOSTRA REGOLA PER IL CANALE ADMIN CON LOG DI DEBUG
Broadcast::channel('admins', function ($user) {
    // Scriviamo un messaggio nel file di log per vedere se entriamo qui
    Log::info('--- Inizio Autorizzazione Canale Admins ---');

    if ($user) {
        Log::info('Utente autenticato trovato:', ['id' => $user->id, 'name' => $user->name]);
        // Usiamo var_export per essere sicuri del tipo di dato (true, 1, '1', false, 0, null?)
        Log::info('Valore di is_admin:', ['is_admin' => var_export($user->is_admin, true)]);
    } else {
        Log::info('Nessun utente autenticato trovato durante l\'autorizzazione del canale.');
        return false;
    }

    $autorizzato = $user->is_admin;
    Log::info('Risultato autorizzazione:', ['autorizzato' => $autorizzato]);
    Log::info('--- Fine Autorizzazione Canale Admins ---');

    return $autorizzato;
});
