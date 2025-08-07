<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrenotazioneTrasferta;
use Illuminate\Http\Request;

class PrenotazioneController extends Controller
{
    public function updateStatus(Request $request, PrenotazioneTrasferta $prenotazione)
    {
        $prenotazione->update(['pagato' => true]);
        return back()->with('success', 'Stato pagamento aggiornato!');
    }
}
