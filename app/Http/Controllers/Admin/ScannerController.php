<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trasferta;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index()
    {
        // Troviamo la prossima trasferta con iscrizioni aperte
        $prossimaTrasferta = Trasferta::where('stato', 'iscrizioni_aperte')
            ->where('data_ora_partita', '>=', now())
            ->orderBy('data_ora_partita', 'asc')
            ->first();

        return view('admin.scanner.index', ['trasferta' => $prossimaTrasferta]);
    }
}
