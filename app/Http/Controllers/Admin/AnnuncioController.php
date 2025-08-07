<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperiamo tutti gli annunci, ordinandoli per i più recenti
        // e caricando in anticipo i dati dell'autore per efficienza.
        $annunci = \App\Models\Annuncio::with('autore')->latest()->get();

        return view('admin.annunci.index', ['annunci' => $annunci]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.annunci.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validiamo i dati in arrivo
        $validated = $request->validate([
            'titolo' => 'required|string|max:255',
            'contenuto' => 'required|string',
            'in_evidenza' => 'nullable', // Accettiamo il campo se presente
        ]);

        // 2. Aggiungiamo l'ID dell'admin che sta creando l'annuncio
        $validated['user_id'] = auth()->id();

        // 3. Gestiamo il valore del checkbox. Se è spuntato, $request->has() sarà true.
        $validated['in_evidenza'] = $request->has('in_evidenza');

        // 4. Creiamo l'annuncio
        \App\Models\Annuncio::create($validated);

        // 5. Reindirizziamo con un messaggio di successo
        return redirect()->route('admin.annunci.index')->with('success', 'Annuncio pubblicato con successo!');
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
        $annuncio = \App\Models\Annuncio::findOrFail($id);
        return view('admin.annunci.edit', ['annuncio' => $annuncio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $annuncio = \App\Models\Annuncio::findOrFail($id);

        $validated = $request->validate([
            'titolo' => 'required|string|max:255',
            'contenuto' => 'required|string',
            'in_evidenza' => 'nullable',
        ]);

        $validated['in_evidenza'] = $request->has('in_evidenza');

        $annuncio->update($validated);

        return redirect()->route('admin.annunci.index')->with('success', 'Annuncio aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $annuncio = \App\Models\Annuncio::findOrFail($id);
        $annuncio->delete();
        return redirect()->route('admin.annunci.index')->with('success', 'Annuncio eliminato con successo!');
    }
}
