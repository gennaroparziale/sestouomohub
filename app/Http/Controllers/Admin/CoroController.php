<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cori = \App\Models\Coro::orderBy('titolo', 'asc')->get();
        return view('admin.cori.index', ['cori' => $cori]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titolo' => 'required|string|max:255',
            'testo' => 'required|string',
            'note' => 'nullable|string',
        ]);

        \App\Models\Coro::create($validated);

        return redirect()->route('admin.cori.index')->with('success', 'Coro aggiunto al libretto!');
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
        $coro = \App\Models\Coro::findOrFail($id);
        return view('admin.cori.edit', ['coro' => $coro]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coro = \App\Models\Coro::findOrFail($id);
        $validated = $request->validate([
            'titolo' => 'required|string|max:255',
            'testo' => 'required|string',
            'note' => 'nullable|string',
        ]);
        $coro->update($validated);
        return redirect()->route('admin.cori.index')->with('success', 'Coro aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coro = \App\Models\Coro::findOrFail($id);
        $coro->delete();
        return redirect()->route('admin.cori.index')->with('success', 'Coro eliminato con successo!');
    }
}
