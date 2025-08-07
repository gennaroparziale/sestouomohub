<?php

namespace App\Http\Controllers;

use App\Models\Sondaggio;
use App\Models\OpzioneSondaggio; // Aggiungi
use App\Models\VotoUtente;       // Aggiungi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   // Aggiungi


class SondaggioController extends Controller
{
    public function index()
    {
        // Recuperiamo i sondaggi aperti
        $sondaggi = Sondaggio::where('stato', 'aperto')->latest()->get();

        // NUOVA LOGICA: Recuperiamo gli ID dei sondaggi già votati dall'utente
        $votiUtenteIds = auth()->user()->votiSondaggi()->pluck('sondaggio_id')->unique()->toArray();

        // Passiamo entrambi i dati alla vista
        return view('sondaggi.index', [
            'sondaggi' => $sondaggi,
            'votiUtenteIds' => $votiUtenteIds
        ]);
    }
    public function vota(Request $request, Sondaggio $sondaggio)
    {
        // 1. Controlli di sicurezza
        if ($sondaggio->stato === 'chiuso') {
            return back()->with('error', 'Le votazioni per questo sondaggio sono chiuse.');
        }

        $giaVotato = $sondaggio->voti()->where('user_id', auth()->id())->exists();
        if ($giaVotato) {
            return back()->with('error', 'Hai già votato a questo sondaggio!');
        }

        // 2. Validazione
        $validated = $request->validate([
            'opzione_sondaggio_id' => 'required|exists:opzioni_sondaggio,id'
        ]);

        try {
            // 3. Transazione: o va tutto a buon fine, o non succede nulla
            DB::transaction(function () use ($sondaggio, $validated) {
                // Salviamo il voto dell'utente
                $sondaggio->voti()->create([
                    'user_id' => auth()->id(),
                    'opzione_sondaggio_id' => $validated['opzione_sondaggio_id'],
                ]);

                // Incrementiamo il contatore dei voti sull'opzione scelta
                OpzioneSondaggio::find($validated['opzione_sondaggio_id'])->increment('voti');
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Si è verificato un errore durante il salvataggio del voto.');
        }

        // 4. Redirect con messaggio di successo
        return redirect()->route('sondaggi.show', $sondaggio)->with('success', 'Il tuo voto è stato registrato con successo!');
    }
    public function show(Sondaggio $sondaggio)
    {
        // Carichiamo le opzioni del sondaggio e il totale dei voti per essere efficienti
        $sondaggio->load('opzioni')->loadCount('voti');

        // Controlliamo se l'utente attuale ha già votato a questo sondaggio
        $votoUtente = $sondaggio->voti()->where('user_id', auth()->id())->first();

        return view('sondaggi.show', [
            'sondaggio' => $sondaggio,
            'votoUtente' => $votoUtente, // Sarà un oggetto se ha votato, altrimenti null
        ]);
    }
}
