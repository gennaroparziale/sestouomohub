<?php

namespace App\Http\Controllers;

use App\Models\TipoTessera;
use App\Models\Tesseramento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\GestisceStagione;

class TesseramentoController extends Controller
{
    use GestisceStagione;
    public function index()
    {
        // 3. Usa la nuova funzione
        $stagione = $this->getStagioneCorrente();
        // Logica semplice per determinare la stagione sportiva corrente
        /*
        $annoCorrente = date('Y');
        $meseCorrente = date('n'); // 'n' per il mese senza zeri iniziali
        $stagione = ($meseCorrente < 9) ? ($annoCorrente - 1) . '/' . $annoCorrente : $annoCorrente . '/' . ($annoCorrente + 1);
*/
        // Recuperiamo le tessere attive che corrispondono alla stagione corrente
        $tipiTessera = TipoTessera::where('attivo', true)
            ->where('stagione', $stagione)
            ->get();

        // NUOVA LOGICA: Recuperiamo gli ID delle tessere a cui l'utente è già iscritto
        $iscrizioniUtenteIds = Auth::user()->tesseramenti()
            ->whereHas('tipoTessera', function($query) use ($stagione) {
                $query->where('stagione', $stagione);
            })
            ->pluck('tipo_tessera_id')->toArray();

        return view('tesseramento.index', [
            'tipiTessera' => $tipiTessera,
            'stagione' => $stagione,
            'iscrizioniUtenteIds' => $iscrizioniUtenteIds, // <-- Passiamo i nuovi dati
        ]);
    }
    public function store(Request $request)
    {
        // 1. Validiamo i dati
        $dati_validati = $request->validate([
            'tipo_tessera_id' => 'required|exists:tipo_tesseras,id'
        ]);

        $utente = Auth::user();
        $tipoTesseraId = $dati_validati['tipo_tessera_id'];

        // 2. NUOVO CONTROLLO: l'utente è già iscritto a QUESTO SPECIFICO tipo di tessera?
        $giaIscritto = Tesseramento::where('user_id', $utente->id)
            ->where('tipo_tessera_id', $tipoTesseraId)
            ->exists();

        if ($giaIscritto) {
            return redirect()->route('tesseramento.index')->with('error', 'Sei già iscritto a questo tipo di tessera!');
        }

        // 3. Creiamo il nuovo tesseramento
        Tesseramento::create([
            'user_id' => $utente->id,
            'tipo_tessera_id' => $tipoTesseraId,
            'data_inizio' => now(),
            'data_fine' => now()->addYear(),
            'stato' => 'non pagato',
        ]);

        // 4. Reindirizziamo
        return redirect()->route('dashboard')->with('success', 'Iscrizione avvenuta con successo!');
    }
}
