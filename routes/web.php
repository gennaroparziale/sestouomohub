<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TesseramentoController;
use App\Http\Controllers\Admin\TrasfertaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TipoTesseraController; // <-- AGGIUNGI QUESTA RIGA IN CIMA
use Illuminate\Support\Facades\Auth; // Aggiungi questa riga in cima al file, se non c'è
use App\Http\Controllers\Admin\TesseramentoController as AdminTesseramentoController; // Rinominiamo per chiarezza

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Carichiamo il tesseramento più recente dell'utente loggato,
    // includendo anche i dettagli del "tipo di tessera" associato.
    $tesseramento = Auth::user()
        ->tesseramenti()
        ->with('tipoTessera')
        ->latest()
        ->first();

    return view('dashboard', ['tesseramento' => $tesseramento]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // NUOVA ROTTA PER IL TESSERAMENTO
    Route::get('/tesseramento', [TesseramentoController::class, 'index'])->name('tesseramento.index');
    Route::post('/tesseramento', [TesseramentoController::class, 'store'])->name('tesseramento.store'); // <-- NUOVA ROTTA

});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // QUESTA RIGA CREA LE ROTTE PER IL CRUD (index, create, store, edit, etc.)
    Route::resource('tipi-tessera', TipoTesseraController::class);
    Route::resource('tesseramenti', AdminTesseramentoController::class); // <-- NUOVA RIGA
    Route::resource('trasferte', TrasfertaController::class); // <-- NUOVA RIGA
});

require __DIR__.'/auth.php';
