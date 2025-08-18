<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoreografiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carichiamo le coreografie con i dati del settore associato per efficienza
        $coreografie = \App\Models\Coreografia::with('settore')->latest()->get();

        return view('admin.coreografie.index', ['coreografie' => $coreografie]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Recuperiamo tutti i settori per il menu a tendina
        $settori = \App\Models\Settore::orderBy('nome')->get();

        return view('admin.coreografie.create', ['settori' => $settori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255', // CORRETTO
            'descrizione_piano' => 'nullable|string', // Reso opzionale
            'settore_id' => 'required|exists:settori,id',
            'data_evento' => 'nullable|date',
        ]);

        \App\Models\Coreografia::create($validated);

        return redirect()->route('admin.coreografie.index')->with('success', 'Progetto coreografia salvato!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Carichiamo la coreografia con i dati del settore associato
        $coreografia = \App\Models\Coreografia::with('settore')->findOrFail($id);

        return view('admin.coreografie.show', [
            'coreografia' => $coreografia,
            'settore' => $coreografia->settore,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coreografia = \App\Models\Coreografia::findOrFail($id);
        $settori = \App\Models\Settore::orderBy('nome')->get();
        return view('admin.coreografie.edit', [
            'coreografia' => $coreografia,
            'settori' => $settori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coreografia = \App\Models\Coreografia::findOrFail($id);
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione_piano' => 'nullable|string',
            'settore_id' => 'required|exists:settori,id',
            'data_evento' => 'nullable|date',
        ]);
        $coreografia->update($validated);
        return redirect()->route('admin.coreografie.index')->with('success', 'Progetto coreografia aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coreografia = \App\Models\Coreografia::findOrFail($id);
        $coreografia->delete();
        return redirect()->route('admin.coreografie.index')->with('success', 'Progetto coreografia eliminato!');
    }

    public function salvaPiano(Request $request, string $id)
    {

        $coreografia = \App\Models\Coreografia::findOrFail($id);

        // Validiamo che i dati in arrivo siano in formato JSON valido
        $validated = $request->validate([
            'piano' => 'required|json',
        ]);

        // Laravel decodificherà il JSON e il 'cast' nel modello lo salverà correttamente come array
        $coreografia->update([
            'piano' => json_decode($validated['piano'])
        ]);

        return back()->with('success', 'Coreografia salvata con successo!');
    }

}
