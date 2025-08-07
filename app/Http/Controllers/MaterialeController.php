<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialeController extends Controller
{
    public function index()
    {
        // Usiamo la relazione che abbiamo definito prima nel modello User
        // per recuperare solo i materiali assegnati all'utente loggato.
        $materialiAssegnati = Auth::user()->materiali()->get();

        return view('materiali.index', ['materiali' => $materialiAssegnati]);
    }
}
