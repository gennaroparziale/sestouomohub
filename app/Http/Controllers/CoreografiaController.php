<?php

namespace App\Http\Controllers;

use App\Models\Coreografia;
use Illuminate\Http\Request;

class CoreografiaController extends Controller
{
    // Mostra la lista di tutte le coreografie
    public function index()
    {
        // Recuperiamo solo le coreografie con una data futura o senza data
        $coreografie = Coreografia::where('data_evento', '>=', now()->today())
            ->orWhereNull('data_evento')
            ->latest('data_evento')
            ->get();
        return view('coreografie.index', ['coreografie' => $coreografie]);
    }

    // Mostra la singola coreografia con il suo disegno
    public function show(Coreografia $coreografia)
    {
        $coreografia->load('settore');
        return view('coreografie.show', [
            'coreografia' => $coreografia,
            'settore' => $coreografia->settore
        ]);
    }
}
