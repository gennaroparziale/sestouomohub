<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Aggiungi in cima
use App\Events\TesseramentoPagato;

class TesseramentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperiamo tutti i tesseramenti, caricando in anticipo i dati dell'utente
        // e del tipo di tessera per ottimizzare le query al database.
        $tesseramenti = \App\Models\Tesseramento::with(['user', 'tipoTessera'])
            ->latest()
            ->get();

        return view('admin.tesseramenti.index', ['tesseramenti' => $tesseramenti]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $tesseramento = \App\Models\Tesseramento::findOrFail($id);

        $validated = $request->validate([
            'stato' => ['required', \Illuminate\Validation\Rule::in(['pagato', 'non pagato', 'in attesa'])],
        ]);

        $tesseramento->update($validated);

        // Se lo stato aggiornato è "pagato", lancia l'evento!
        if ($tesseramento->stato == 'pagato') {
            TesseramentoPagato::dispatch($tesseramento);
        }

        return redirect()->route('admin.tesseramenti.index')->with('success', 'Stato tesseramento aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
