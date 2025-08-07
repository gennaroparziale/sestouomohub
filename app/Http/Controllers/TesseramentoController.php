<?php

namespace App\Http\Controllers;

use App\Models\TipoTessera;
use App\Models\Tesseramento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TesseramentoController extends Controller
{
    public function index()
    {
        // Logica semplice per determinare la stagione sportiva corrente
        $annoCorrente = date('Y');
        $meseCorrente = date('n'); // 'n' per il mese senza zeri iniziali
        $stagione = ($meseCorrente < 9) ? ($annoCorrente - 1) . '/' . $annoCorrente : $annoCorrente . '/' . ($annoCorrente + 1);

        // Recuperiamo le tessere attive che corrispondono alla stagione corrente
        $tipiTessera = TipoTessera::where('attivo', true)
            ->where('stagione', $stagione)
            ->get();

        // Passiamo i dati a una nuova vista
        return view('tesseramento.index', [
            'tipiTessera' => $tipiTessera,
            'stagione' => $stagione
        ]);
    }
    public function store(Request $request)
    {
        // 1. Validiamo i dati (ci assicuriamo che l'ID esista e sia valido)
        $dati_validati = $request->validate([
            'tipo_tessera_id' => 'required|exists:tipo_tesseras,id'
        ]);

        $tipoTessera = TipoTessera::find($dati_validati['tipo_tessera_id']);
        $utente = Auth::user();

        // 2. CONTROLLO FONDAMENTALE: l'utente è già tesserato per questa stagione?
        $giaTesserato = Tesseramento::where('user_id', $utente->id)
            ->whereHas('tipoTessera', function ($query) use ($tipoTessera) {
                $query->where('stagione', $tipoTessera->stagione);
            })
            ->exists();

        if ($giaTesserato) {
            return redirect()->route('tesseramento.index')->with('error', 'Sei già iscritto a una tessera per la stagione ' . $tipoTessera->stagione . '!');
        }

        // 3. Se i controlli passano, creiamo il nuovo tesseramento
        Tesseramento::create([
            'user_id' => $utente->id,
            'tipo_tessera_id' => $tipoTessera->id,
            'data_inizio' => now(), // Data di oggi
            'data_fine' => now()->addYear(), // Scade tra un anno (logica da affinare in futuro)
            'stato' => 'non pagato',
        ]);

        // 4. Reindirizziamo alla dashboard con un messaggio di successo
        return redirect()->route('dashboard')->with('success', 'Iscrizione avvenuta con successo! A breve riceverai le indicazioni per il pagamento.');
    }
}
