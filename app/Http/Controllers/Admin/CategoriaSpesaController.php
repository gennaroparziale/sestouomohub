<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaSpesa;
use Illuminate\Http\Request;

class CategoriaSpesaController extends Controller
{
    public function index()
    {
        $categorie = CategoriaSpesa::orderBy('nome')->get();
        return view('admin.categorie-spesa.index', ['categorie' => $categorie]);
    }

    public function create()
    {
        return view('admin.categorie-spesa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|unique:categoria_spesas,nome|max:255',
        ]);
        CategoriaSpesa::create($validated);
        return redirect()->route('admin.categorie-spesa.index')->with('success', 'Categoria creata con successo!');
    }

    public function edit(string $id)
    {
        $categoria = CategoriaSpesa::findOrFail($id);
        return view('admin.categorie-spesa.edit', ['categoria' => $categoria]);
    }

    public function update(Request $request, string $id)
    {
        $categoria = CategoriaSpesa::findOrFail($id);
        $validated = $request->validate([
            'nome' => 'required|string|unique:categoria_spesas,nome,' . $categoria->id . '|max:255',
        ]);
        $categoria->update($validated);
        return redirect()->route('admin.categorie-spesa.index')->with('success', 'Categoria aggiornata con successo!');
    }

    public function destroy(string $id)
    {
        $categoria = CategoriaSpesa::findOrFail($id);
        $categoria->delete();
        return redirect()->route('admin.categorie-spesa.index')->with('success', 'Categoria eliminata con successo!');
    }
}
