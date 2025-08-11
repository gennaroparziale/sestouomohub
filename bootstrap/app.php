<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
        // NUOVA RIGA: Aggiungiamo l'eccezione per il webhook di Stripe
        // --- QUESTA È LA SINTASSI CORRETTA ---
        // Metodo corretto per l'eccezione CSRF
        $middleware->validateCsrfTokens(except: [
            'stripe/webhook'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
