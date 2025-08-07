<?php

namespace App\Http\Controllers;

use App\Models\Coro;
use Illuminate\Http\Request;

class CoroController extends Controller
{
    public function index()
    {
        $cori = Coro::orderBy('titolo', 'asc')->get();
        return view('cori.index', ['cori' => $cori]);
    }
}
