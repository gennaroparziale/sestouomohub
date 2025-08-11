<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoriaSpesa;

class TransazioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Aggiungiamo with('categoriaSpesa') per caricare la relazione
        $transazioni = \App\Models\Transazione::with('categoriaSpesa')
            ->latest('data_transazione')
            ->get();

        $saldo = \App\Models\Transazione::sum(DB::raw("IF(tipo = 'entrata', importo, -importo)"));

        return view('admin.transazioni.index', [
            'transazioni' => $transazioni,
            'saldo' => $saldo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorie = CategoriaSpesa::orderBy('nome')->get();
        return view('admin.transazioni.create', ['categorie' => $categorie]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'data_transazione' => 'required|date',
            'descrizione' => 'required|string|max:255',
            'importo' => 'required|numeric|min:0',
            'tipo' => 'required|in:entrata,uscita',
            'categoria_spesa_id' => 'nullable|exists:categoria_spesas,id',
            'metodo_pagamento' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        \App\Models\Transazione::create($validated);

        return redirect()->route('admin.transazioni.index')->with('success', 'Transazione registrata con successo!');
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
        $transazione = \App\Models\Transazione::findOrFail($id);
        $categorie = CategoriaSpesa::orderBy('nome')->get();
        return view('admin.transazioni.edit', [
            'transazione' => $transazione,
            'categorie' => $categorie
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transazione = \App\Models\Transazione::findOrFail($id);
        $validated = $request->validate([
            'data_transazione' => 'required|date',
            'descrizione' => 'required|string|max:255',
            'importo' => 'required|numeric|min:0',
            'tipo' => 'required|in:entrata,uscita',
            'categoria_spesa_id' => 'nullable|exists:categoria_spesas,id',
            'metodo_pagamento' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);
        $transazione->update($validated);
        return redirect()->route('admin.transazioni.index')->with('success', 'Transazione aggiornata!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transazione = \App\Models\Transazione::findOrFail($id);
        $transazione->delete();
        return redirect()->route('admin.transazioni.index')->with('success', 'Transazione eliminata!');
    }
}
