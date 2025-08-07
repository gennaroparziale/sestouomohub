<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Aggiungi questa riga in cima al file, se non c'è
use App\Http\Controllers\ProfileController;

// Controller Admin
use App\Http\Controllers\Admin\TipoTesseraController;
use App\Http\Controllers\Admin\TrasfertaController as AdminTrasfertaController;
use App\Http\Controllers\Admin\TesseramentoController as AdminTesseramentoController;
use App\Http\Controllers\Admin\PrenotazioneController;
use App\Http\Controllers\Admin\MaterialeController as AdminMaterialeController;;
use App\Http\Controllers\Admin\AnnuncioController;
use App\Http\Controllers\Admin\SondaggioController as AdminSondaggioController;
use App\Http\Controllers\Admin\CoroController as AdminCoroController;
use App\Http\Controllers\Admin\ProdottoController;

// Controller Utente
use App\Http\Controllers\TesseramentoController;
use App\Http\Controllers\TrasfertaController;
use App\Http\Controllers\MaterialeController;
use App\Http\Controllers\SondaggioController;
use App\Http\Controllers\CoroController;



Route::get('/', function () {
    return redirect()->route('login');
});

// ROTTA PER LA DASHBOARD //////////////
Route::get('/dashboard', function () {
    // Dati tesseramento (già esistente)
    $tesseramento = Auth::user()->tesseramenti()->with('tipoTessera')->latest()->first();

    // NUOVA LOGICA: Recuperiamo gli ultimi 5 annunci
    // Dando priorità a quelli "in evidenza"
    $annunci = \App\Models\Annuncio::with('autore')
        ->orderBy('in_evidenza', 'desc')
        ->latest() // Ordina per data di creazione, i più nuovi prima
        ->take(5)    // Prendiamo solo gli ultimi 5
        ->get();

    // Passiamo tutti i dati necessari alla vista
    return view('dashboard', [
        'tesseramento' => $tesseramento,
        'annunci'      => $annunci,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');
// ***************************************************************** //

// ROTTE UTENTE NORMALE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // NUOVA ROTTA PER IL TESSERAMENTO
    Route::get('/tesseramento', [TesseramentoController::class, 'index'])->name('tesseramento.index');
    Route::post('/tesseramento', [TesseramentoController::class, 'store'])->name('tesseramento.store'); // <-- NUOVA ROTTA
    // NUOVA ROTTA PER LE TRASFERTE DEGLI UTENTI
    // Trasferte Utente
    Route::get('/trasferte', [TrasfertaController::class, 'index'])->name('trasferte.index');
    Route::post('/trasferte/{trasferta}', [TrasfertaController::class, 'prenota'])->name('trasferte.prenota'); // <-- NUOVA ROTTA
    Route::get('/i-miei-materiali', [MaterialeController::class, 'index'])->name('materiali.index');
    Route::get('/sondaggi', [SondaggioController::class, 'index'])->name('sondaggi.index');
    Route::get('/sondaggi/{sondaggio}', [SondaggioController::class, 'show'])->name('sondaggi.show');
    Route::post('/sondaggi/{sondaggio}/vota', [SondaggioController::class, 'vota'])->name('sondaggi.vota'); // <-- NUOVA ROTTA
    Route::get('/cori', [CoroController::class, 'index'])->name('cori.index');
});

// ROTTE ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // QUESTA RIGA CREA LE ROTTE PER IL CRUD (index, create, store, edit, etc.)
    Route::resource('tipi-tessera', TipoTesseraController::class);
    Route::resource('tesseramenti', AdminTesseramentoController::class); // <-- NUOVA RIGA
    Route::resource('trasferte', AdminTrasfertaController::class);
    // NUOVA ROTTA PER LA LISTA PRENOTAZIONI DI UNA SINGOLA TRASFERTA
    Route::get('/trasferte/{trasferta}/prenotazioni', [AdminTrasfertaController::class, 'showPrenotazioni'])->name('trasferte.prenotazioni');
    Route::patch('/prenotazioni/{prenotazione}/update-status', [PrenotazioneController::class, 'updateStatus'])->name('prenotazioni.updateStatus');
    Route::resource('materiali', AdminMaterialeController::class); // <-- Assicurati che qui ci sia il controller con l'alias
    Route::resource('annunci', AnnuncioController::class); // <-- NUOVA RIGA
    Route::resource('sondaggi', AdminSondaggioController::class);
    Route::resource('cori', AdminCoroController::class);
    Route::resource('prodotti', ProdottoController::class);
});

require __DIR__.'/auth.php';
