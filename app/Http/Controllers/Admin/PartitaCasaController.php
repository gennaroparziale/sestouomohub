<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartitaCasa;
use App\Traits\GestisceStagione;
use Illuminate\Http\Request;

class PartitaCasaController extends Controller
{
    use GestisceStagione;

    public function index()
    {
        $partite = PartitaCasa::orderBy('data_ora_partita', 'desc')->get();
        return view('admin.partite-in-casa.index', ['partite' => $partite]);
    }

    public function create()
    {
        $stagioneCorrente = $this->getStagioneCorrente();
        return view('admin.partite-in-casa.create', ['stagioneCorrente' => $stagioneCorrente]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'avversario' => 'required|string|max:255',
            'data_ora_partita' => 'required|date',
            'stagione' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        PartitaCasa::create($validated);
        return redirect()->route('admin.partite-in-casa.index')->with('success', 'Partita in casa aggiunta al calendario!');
    }

    public function edit(string $id)
    {
        $partita = PartitaCasa::findOrFail($id);
        return view('admin.partite-in-casa.edit', ['partita' => $partita]);
    }

    public function update(Request $request, string $id)
    {
        $partita = PartitaCasa::findOrFail($id);
        $validated = $request->validate([
            'avversario' => 'required|string|max:255',
            'data_ora_partita' => 'required|date',
            'stagione' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);
        $partita->update($validated);
        return redirect()->route('admin.partite-in-casa.index')->with('success', 'Partita aggiornata con successo!');
    }

    public function destroy(string $id)
    {
        $partita = PartitaCasa::findOrFail($id);
        $partita->delete();
        return redirect()->route('admin.partite-in-casa.index')->with('success', 'Partita eliminata dal calendario!');
    }
}
