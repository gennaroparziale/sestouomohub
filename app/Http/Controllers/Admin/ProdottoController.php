<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // <-- Aggiungi in cima

class ProdottoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Usiamo with('varianti') per caricare in anticipo tutte le varianti
        // associate a ogni prodotto. Questo è super efficiente!
        $prodotti = \App\Models\Prodotto::with('varianti')->latest()->get();

        return view('admin.prodotti.index', ['prodotti' => $prodotti]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prodotti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'immagine' => 'nullable|image|max:2048',
            'is_visibile' => 'nullable',
            'varianti' => 'required|array|min:1',
            'varianti.*.nome' => 'required|string|max:255',
            'varianti.*.prezzo' => 'required|numeric|min:0',
            'varianti.*.quantita_disponibile' => 'required|integer|min:0',
        ]);

        try {
            DB::transaction(function () use ($request, $validated) {
                $percorsoImmagine = null;
                if ($request->hasFile('immagine')) {
                    $percorsoImmagine = $request->file('immagine')->store('prodotti', 'public');
                }

                $prodotto = \App\Models\Prodotto::create([
                    'nome' => $validated['nome'],
                    'slug' => Str::slug($validated['nome']),
                    'descrizione' => $validated['descrizione'],
                    'immagine' => $percorsoImmagine,
                    'is_visibile' => $request->has('is_visibile'),
                ]);

                foreach ($validated['varianti'] as $varianteData) {
                    $prodotto->varianti()->create($varianteData);
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Errore durante la creazione del prodotto.');
        }

        return redirect()->route('admin.prodotti.index')->with('success', 'Prodotto con varianti creato con successo!');
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
        // Troviamo il prodotto e carichiamo in anticipo le sue varianti
        $prodotto = \App\Models\Prodotto::with('varianti')->findOrFail($id);

        return view('admin.prodotti.edit', ['prodotto' => $prodotto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $prodotto = \App\Models\Prodotto::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'nullable|string',
            'immagine' => 'nullable|image|max:2048',
            'is_visibile' => 'nullable',
            'varianti' => 'present|array', // Il campo varianti deve esistere, anche se è un array vuoto
            'varianti.*.id' => 'nullable|integer|exists:varianti_prodotto,id',
            'varianti.*.nome' => 'required|string|max:255',
            'varianti.*.prezzo' => 'required|numeric|min:0',
            'varianti.*.quantita_disponibile' => 'required|integer|min:0',
        ]);

        try {
            DB::transaction(function () use ($request, $prodotto, $validated) {
                // 1. Aggiorna i dati del prodotto principale
                $updateData = [
                    'nome' => $validated['nome'],
                    'slug' => Str::slug($validated['nome']),
                    'descrizione' => $validated['descrizione'],
                    'is_visibile' => $request->has('is_visibile'),
                ];

                if ($request->hasFile('immagine')) {
                    if ($prodotto->immagine) {
                        Storage::disk('public')->delete($prodotto->immagine);
                    }
                    $updateData['immagine'] = $request->file('immagine')->store('prodotti', 'public');
                }
                $prodotto->update($updateData);

                // 2. Sincronizza le varianti
                $idsVariantiInviate = [];
                foreach ($validated['varianti'] as $varianteData) {
                    if (isset($varianteData['id']) && $varianteData['id']) {
                        // Se la variante ha un ID, la aggiorniamo
                        $variante = \App\Models\VarianteProdotto::find($varianteData['id']);
                        if ($variante) {
                            $variante->update($varianteData);
                            $idsVariantiInviate[] = $variante->id;
                        }
                    } else {
                        // Se non ha un ID, è una nuova variante e la creiamo
                        $nuovaVariante = $prodotto->varianti()->create($varianteData);
                        $idsVariantiInviate[] = $nuovaVariante->id;
                    }
                }

                // 3. Elimina le varianti che non sono state inviate (quelle rimosse dall'utente)
                $prodotto->varianti()->whereNotIn('id', $idsVariantiInviate)->delete();
            });
        } catch (\Exception $e) {
            // Puoi aggiungere un log dell'errore: \Log::error($e->getMessage());
            return back()->with('error', 'Errore durante l\'aggiornamento del prodotto.');
        }

        return redirect()->route('admin.prodotti.index')->with('success', 'Prodotto aggiornato con successo!');
    }

    public function destroy(string $id)
    {
        $prodotto = \App\Models\Prodotto::findOrFail($id);

        // Cancella l'immagine dal disco prima di cancellare il record dal database.
        if ($prodotto->immagine) {
            Storage::disk('public')->delete($prodotto->immagine);
        }

        $prodotto->delete();
        return redirect()->route('admin.prodotti.index')->with('success', 'Prodotto eliminato con successo!');
    }
}
