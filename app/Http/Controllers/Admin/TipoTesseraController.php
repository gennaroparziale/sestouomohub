<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoTessera;
use Illuminate\Http\Request;

class TipoTesseraController extends Controller
{
    public function index()
    {
        $tipiTessera = TipoTessera::all();
        return view('admin.tipi-tessera.index', ['tipiTessera' => $tipiTessera]);
    }

    public function create()
    {
        return view('admin.tipi-tessera.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'prezzo' => 'required|numeric|min:0',
            'stagione' => 'required|string|max:255',
        ]);
        TipoTessera::create($validated);
        return redirect()->route('admin.tipi-tessera.index')->with('success', 'Tipo tessera creato con successo!');
    }

    public function show(string $id)
    {
        // Non lo usiamo per ora
    }

    // --- METODI AGGIORNATI ---

    public function edit(string $id)
    {
        $tessera = TipoTessera::findOrFail($id);
        return view('admin.tipi-tessera.edit', ['tessera' => $tessera]);
    }

    public function update(Request $request, string $id)
    {
        $tessera = TipoTessera::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'prezzo' => 'required|numeric|min:0',
            'stagione' => 'required|string|max:255',
        ]);

        $tessera->update($validated);

        return redirect()->route('admin.tipi-tessera.index')->with('success', 'Tipo tessera aggiornato con successo!');
    }

    public function destroy(string $id)
    {
        $tessera = TipoTessera::findOrFail($id);
        $tessera->delete();
        return redirect()->route('admin.tipi-tessera.index')->with('success', 'Tipo tessera eliminato con successo!');
    }
}
