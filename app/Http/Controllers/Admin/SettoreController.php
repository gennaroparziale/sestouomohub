<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settore;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSettoreRequest;

class SettoreController extends Controller
{
    public function index()
    {
        $settori = Settore::orderBy('nome')->get();
        return view('admin.settori.index', ['settori' => $settori]);
    }

    public function create()
    {
        return view('admin.settori.create');
    }
/*
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'numero_file' => 'required|integer|min:1',
            'posti_per_fila' => 'required|integer|min:1',
        ]);

        Settore::create($validated);
        return redirect()->route('admin.settori.index')->with('success', 'Settore creato con successo!');
    }
  */
    public function store(StoreSettoreRequest $request)
    {
        // La validazione ora è AUTOMATICA! Se non passa, l'utente viene reindirizzato.
        // $request->validated() ci dà solo i dati che hanno superato i controlli.
        Settore::create($request->validated());

        return redirect()->route('admin.settori.index')->with('success', 'Settore creato con successo!');
    }


    public function edit(string $id)
    {
        $settore = Settore::findOrFail($id);
        return view('admin.settori.edit', ['settore' => $settore]);
    }
    /*
    public function update(Request $request, string $id)
    {
        $settore = Settore::findOrFail($id);
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'numero_file' => 'required|integer|min:1',
            'posti_per_fila' => 'required|integer|min:1',
        ]);
        $settore->update($validated);
        return redirect()->route('admin.settori.index')->with('success', 'Settore aggiornato con successo!');
    } */
    public function update(StoreSettoreRequest $request, string $id)
    {
        $settore = Settore::findOrFail($id);

        // Anche qui, validazione automatica!
        $settore->update($request->validated());

        return redirect()->route('admin.settori.index')->with('success', 'Settore aggiornato con successo!');
    }

    public function destroy(string $id)
    {
        $settore = Settore::findOrFail($id);
        $settore->delete();
        return redirect()->route('admin.settori.index')->with('success', 'Settore eliminato con successo!');
    }
}
