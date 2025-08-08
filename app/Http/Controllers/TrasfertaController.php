<?php

namespace App\Http\Controllers;

use App\Notifications\NuovaPrenotazioneTrasfertaNotification;
use Illuminate\Http\Request;
use App\Models\Trasferta;
use App\Models\PrenotazioneTrasferta;
use Illuminate\Support\Facades\Auth;
use App\Traits\GestisceStagione;
use App\Events\TrasfertaPrenotata;

class TrasfertaController extends Controller
{
    use GestisceStagione;
    public function index()
    {
        $stagione = $this->getStagioneCorrente();
        // Recuperiamo le trasferte aperte o complete, aggiungendo il filtro sulla stagione
        $trasferteDisponibili = Trasferta::whereIn('stato', ['iscrizioni_aperte', 'completa'])
            ->where('stagione', $stagione) // <-- FILTRO AGGIUNTO
            ->withCount('prenotazioni')
            ->orderBy('data_ora_partita', 'asc')
            ->get();

        $prenotazioniUtenteIds = Auth::user()->prenotazioniTrasferte()->pluck('trasferta_id')->toArray();

        // Passiamo anche la stagione alla vista, così possiamo mostrarla nel titolo
        return view('trasferte.index', [
            'trasferte' => $trasferteDisponibili,
            'prenotazioniUtenteIds' => $prenotazioniUtenteIds,
            'stagione' => $stagione, // <-- Passiamo la stagione alla vista
        ]);
    }

    public function prenota(Request $request, Trasferta $trasferta)
    {

        $utente = Auth::user();

        // --- Iniziano i controlli di sicurezza ---

        // 1. La trasferta è ancora aperta?
        if ($trasferta->stato !== 'iscrizioni_aperte') {
            return redirect()->route('trasferte.index')->with('error', 'Le iscrizioni per questa trasferta sono chiuse!');
        }

        // 2. Ci sono ancora posti liberi?
        // Contiamo quante prenotazioni già esistono per questa trasferta
        $postiOccupati = $trasferta->prenotazioni()->count();
        if ($postiOccupati >= $trasferta->posti_disponibili) {
            return redirect()->route('trasferte.index')->with('error', 'Spiacenti, i posti per questa trasferta sono esauriti!');
        }

        // 3. L'utente si è già prenotato?
        $giaPrenotato = $utente->prenotazioniTrasferte()->where('trasferta_id', $trasferta->id)->exists();
        if ($giaPrenotato) {
            return redirect()->route('trasferte.index')->with('error', 'Hai già prenotato il tuo posto per questa trasferta!');
        }

        // --- Se tutti i controlli passano, procediamo ---

        // Creiamo la prenotazione
        $prenotazione=PrenotazioneTrasferta::create([
            'user_id' => $utente->id,
            'trasferta_id' => $trasferta->id,
        ]);
        \App\Events\TrasfertaPrenotata::dispatch($prenotazione);

        // Se abbiamo occupato l'ultimo posto, cambiamo lo stato della trasferta in "completa"
        if (($postiOccupati + 1) == $trasferta->posti_disponibili) {
            $trasferta->update(['stato' => 'completa']);
        }


        // Reindirizziamo alla dashboard con un messaggio di successo
        return redirect()->route('dashboard')->with('success', 'Prenotazione effettuata con successo per la trasferta contro ' . $trasferta->avversario . '!');
    }
}
