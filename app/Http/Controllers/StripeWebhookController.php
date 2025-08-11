<?php

namespace App\Http\Controllers;

use App\Events\TesseramentoPagato;
use App\Models\Tesseramento;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends CashierController
{
    /**
     * Handle a checkout session completed event.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function handleCheckoutSessionCompleted(array $payload)
    {
        // Prendiamo i nostri metadati dal payload di Stripe
        $tesseramentoId = $payload['data']['object']['metadata']['tesseramento_id'] ?? null;

        if ($tesseramentoId) {
            $tesseramento = Tesseramento::find($tesseramentoId);

            // Se troviamo il tesseramento e non è ancora pagato...
            if ($tesseramento && $tesseramento->stato !== 'pagato') {
                // ...lo segniamo come pagato!
                //$tesseramento->update(['stato' => 'pagato']);
                $tesseramento->update(['stato' => 'pagato', 'metodo_pagamento' => 'Carta di Credito']);


                // E lanciamo il nostro evento per creare la transazione e la notifica!
                TesseramentoPagato::dispatch($tesseramento);
            }
        }

        return $this->successResponse();
    }
}
