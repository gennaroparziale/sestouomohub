<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SondaggioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperiamo tutti i sondaggi, contando in anticipo opzioni e voti per efficienza
        $sondaggi = \App\Models\Sondaggio::withCount(['opzioni', 'voti'])->latest()->get();

        return view('admin.sondaggi.index', ['sondaggi' => $sondaggi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sondaggi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validiamo i dati
        $validated = $request->validate([
            'domanda' => 'required|string|max:255',
            'opzioni' => 'required|array|min:2',
            'opzioni.*' => 'required|string|max:255', // Valida ogni opzione nell'array
        ]);

        try {
            // 2. Usiamo una transazione per la massima sicurezza
            DB::transaction(function () use ($validated) {
                // Creiamo il sondaggio principale
                $sondaggio = \App\Models\Sondaggio::create([
                    'domanda' => $validated['domanda']
                ]);

                // Creiamo le opzioni collegate
                foreach ($validated['opzioni'] as $testoOpzione) {
                    $sondaggio->opzioni()->create(['testo_opzione' => $testoOpzione]);
                }
            });
        } catch (\Exception $e) {
            // Se qualcosa va storto, torniamo indietro con un errore
            return back()->with('error', 'Errore durante la creazione del sondaggio.');
        }

        // 3. Reindirizziamo con un messaggio di successo
        return redirect()->route('admin.sondaggi.index')->with('success', 'Sondaggio creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
