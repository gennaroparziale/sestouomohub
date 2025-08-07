<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MaterialeTipoEnum;
use Illuminate\Validation\Rules\Enum as EnumRule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperiamo tutto il materiale, caricando anche i dati del responsabile
        $materiali = \App\Models\Materiale::with('responsabile')->latest()->get();

        // Passiamo i dati alla vista
        return view('admin.materiali.index', ['materiali' => $materiali]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Recuperiamo tutti gli utenti, ordinati per cognome
        $users = \App\Models\User::orderBy('cognome')->get();

        return view('admin.materiali.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'tipo' => ['required', new EnumRule(MaterialeTipoEnum::class)],
            'quantita' => 'required|integer|min:1',
            'stato' => 'required|in:disponibile,in sede,in trasferta,in riparazione,ritirato',
            'responsabile_id' => 'nullable|exists:users,id',
            'note' => 'nullable|string',
        ]);

        \App\Models\Materiale::create($validated);

        return redirect()->route('admin.materiali.index')->with('success', 'Materiale aggiunto all\'inventario!');
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
        $materiale = \App\Models\Materiale::findOrFail($id);
        $users = \App\Models\User::orderBy('cognome')->get(); // Ci serve di nuovo la lista utenti

        return view('admin.materiali.edit', [
            'materiale' => $materiale,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $materiale = \App\Models\Materiale::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'tipo' => ['required', new EnumRule(MaterialeTipoEnum::class)],
            'quantita' => 'required|integer|min:1',
            'stato' => 'required|in:disponibile,in sede,in trasferta,in riparazione,ritirato',
            'responsabile_id' => 'nullable|exists:users,id',
            'note' => 'nullable|string',
        ]);

        $materiale->update($validated);

        return redirect()->route('admin.materiali.index')->with('success', 'Materiale aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $materiale = \App\Models\Materiale::findOrFail($id);
        $materiale->delete();
        return redirect()->route('admin.materiali.index')->with('success', 'Materiale eliminato dall\'inventario!');
    }
}
