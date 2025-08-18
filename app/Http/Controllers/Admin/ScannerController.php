<?php

namespace App\Http\Controllers\Admin;

use App\Models\Presenza;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Trasferta;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index()
    {
        // Troviamo la prossima trasferta
        $prossimaTrasferta = Trasferta::where('stato', 'iscrizioni_aperte')
            ->where('data_ora_partita', '>=', now())
            ->orderBy('data_ora_partita', 'asc')
            ->first();
        // Troviamo la prossima partita in casa
        $prossimaPartitaCasa = PartitaCasa::where('data_ora_partita', '>=', now())
            ->orderBy('data_ora_partita', 'asc')
            ->first();

        $prossimoEvento = null;
        // Scegliamo l'evento più vicino nel tempo
        if ($prossimaTrasferta && $prossimaPartitaCasa) {
            $prossimoEvento = $prossimaTrasferta->data_ora_partita->isBefore($prossimaPartitaCasa->data_ora_partita)
                ? $prossimaTrasferta
                : $prossimaPartitaCasa;
        } else {
            $prossimoEvento = $prossimaTrasferta ?? $prossimaPartitaCasa;
        }

        return view('admin.scanner.index', ['evento' => $prossimoEvento]);
    }
    public function checkIn(Request $request)
    {
        // Validiamo i dati in arrivo dallo scanner
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'evento_id' => 'required|integer',
            'evento_type' => 'required|string',
        ]);

        // Troviamo il modello dell'evento (es. Trasferta o PartitaCasa)
        $modelloEvento = $data['evento_type']::find($data['evento_id']);
        if (!$modelloEvento) {
            return response()->json(['success' => false, 'message' => 'Evento non trovato.']);
        }

        // Controlliamo se l'utente è già stato registrato per questo evento
        $giaPresente = $modelloEvento->presenze()->where('user_id', $data['user_id'])->exists();
        if ($giaPresente) {
            $utente = User::find($data['user_id']);
            return response()->json(['success' => false, 'message' => 'Presenza già registrata per ' . $utente->name]);
        }

        // Creiamo la presenza usando la nostra relazione polimorfica!
        $modelloEvento->presenze()->create([
            'user_id' => $data['user_id'],
            'scansionato_da_user_id' => Auth::id(),
        ]);

        $utente = User::find($data['user_id']);
        return response()->json(['success' => true, 'message' => 'Presenza registrata per ' . $utente->name]);
    }
}
