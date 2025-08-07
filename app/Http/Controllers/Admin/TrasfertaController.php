<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrasfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ordiniamo per la data della partita, in modo ascendente (dalla più vicina alla più lontana)
        $trasferte = \App\Models\Trasferta::withCount('prenotazioni')->orderBy('data_ora_partita', 'asc')->get();
        return view('admin.trasferte.index', ['trasferte' => $trasferte]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.trasferte.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validazione di tutti i campi
        $validated = $request->validate([
            'avversario' => 'required|string|max:255',
            'luogo_partita' => 'required|string|max:255',
            'stagione' => 'required|string|max:255', // <-- AGGIUNGI QUESTA REGOLA
            'data_ora_partita' => 'required|date',
            'data_ora_ritrovo' => 'required|date',
            'luogo_ritrovo' => 'required|string|max:255',
            'mezzo_trasporto' => 'required|in:auto,van,pullman,aereo,traghetto',
            'costo' => 'required|numeric|min:0',
            'posti_disponibili' => 'required|integer|min:1',
            'note_logistiche' => 'nullable|string',
            'stato' => 'required|in:pianificata,iscrizioni_aperte,completa,annullata,conclusa', // <-- AGGIUNGI QUESTA
        ]);

        // 2. Creazione della trasferta nel database
        \App\Models\Trasferta::create($validated);

        // 3. Redirect alla pagina della lista con un messaggio di successo
        return redirect()->route('admin.trasferte.index')->with('success', 'Trasferta creata con successo!');
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
        $trasferta = \App\Models\Trasferta::findOrFail($id);
        return view('admin.trasferte.edit', ['trasferta' => $trasferta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Troviamo la trasferta esistente
        $trasferta = \App\Models\Trasferta::findOrFail($id);

        // La validazione è la stessa della creazione
        $validated = $request->validate([
            'avversario' => 'required|string|max:255',
            'luogo_partita' => 'required|string|max:255',
            'stagione' => 'required|string|max:255',
            'data_ora_partita' => 'required|date',
            'data_ora_ritrovo' => 'required|date',
            'luogo_ritrovo' => 'required|string|max:255',
            'mezzo_trasporto' => 'required|in:auto,van,pullman,aereo,traghetto',
            'costo' => 'required|numeric|min:0',
            'posti_disponibili' => 'required|integer|min:1',
            'note_logistiche' => 'nullable|string',
            'stato' => 'required|in:pianificata,iscrizioni_aperte,completa,annullata,conclusa', // <-- AGGIUNGI QUESTA
        ]);

        // Aggiorniamo il record con i dati validati
        $trasferta->update($validated);

        // Reindirizziamo con un messaggio di successo
        return redirect()->route('admin.trasferte.index')->with('success', 'Trasferta aggiornata con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Troviamo la trasferta da eliminare
        $trasferta = \App\Models\Trasferta::findOrFail($id);

        // La eliminiamo
        $trasferta->delete();

        // Reindirizziamo con un messaggio di successo
        return redirect()->route('admin.trasferte.index')->with('success', 'Trasferta eliminata con successo!');
    }
    public function showPrenotazioni(string $id)
    {
        // 1. Troviamo la trasferta specifica usando l'ID che arriva dall'URL.
        $trasferta = \App\Models\Trasferta::findOrFail($id);

        // 2. Carichiamo tutte le sue prenotazioni. Per ogni prenotazione,
        // carichiamo in anticipo anche i dati dell'utente associato per essere più efficienti.
        $prenotazioni = $trasferta->prenotazioni()->with('user')->get();

        // 3. Passiamo la trasferta e la lista delle prenotazioni alla nuova vista.
        return view('admin.trasferte.prenotazioni', [
            'trasferta' => $trasferta,
            'prenotazioni' => $prenotazioni,
        ]);
    }
}
