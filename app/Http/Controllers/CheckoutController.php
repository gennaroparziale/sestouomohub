<?php

namespace App\Http\Controllers;

use App\Models\Tesseramento;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkoutTesseramento(Request $request, Tesseramento $tesseramento)
    {
        $user = $request->user();
        $tipoTessera = $tesseramento->tipoTessera;

        // Controllo di sicurezza: la tessera ha un prezzo collegato su Stripe?
        if (!$tipoTessera->stripe_price_id) {
            return back()->with('error', 'Questo prodotto non è al momento acquistabile online.');
        }

        // La magia di Cashier: crea la sessione di checkout e reindirizza l'utente a Stripe
        return $user->checkout([$tipoTessera->stripe_price_id => 1], [
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            // AGGIUNGIAMO IL NOSTRO PROMEMORIA
            'metadata' => [
                'tesseramento_id' => $tesseramento->id,
            ],
        ]);
    }

    public function success(Request $request)
    {
        // Qui potremmo aggiungere logica extra per controllare la sessione se necessario
        return redirect()->route('dashboard')->with('success', 'Pagamento effettuato con successo! Grazie.');
    }

    public function cancel()
    {
        return redirect()->route('dashboard')->with('error', 'Pagamento annullato.');
    }
}
