<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnnuncioRequest;

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
    public function store(StoreAnnuncioRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();
        $validated['in_evidenza'] = $request->has('in_evidenza');

        \App\Models\Annuncio::create($validated);

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
    public function update(StoreAnnuncioRequest $request, string $id)
    {
        $annuncio = \App\Models\Annuncio::findOrFail($id);

        $validated = $request->validated();
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
