<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use App\View\Composers\NotificationComposer;

// Eventi e Listener che abbiamo creato
use App\Events\TesseramentoPagato;
use App\Listeners\CreaTransazionePerTesseramento;
use App\Events\NuovaSottoscrizioneTessera;
use App\Listeners\NotificaAdminNuovaSottoscrizione;
use App\Events\TrasfertaPrenotata;
use App\Listeners\NotificaAdminNuovaPrenotazione;
use Illuminate\Auth\Events\Registered;
use App\Listeners\NotificaAdminNuovoUtente;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(
            'layouts.navigation', NotificationComposer::class
        );

        // --- Le nostre regole Evento -> Listener ---
        /*
        Event::listen(Registered::class, NotificaAdminNuovoUtente::class);
        Event::listen(TesseramentoPagato::class, CreaTransazionePerTesseramento::class);
        Event::listen(NuovaSottoscrizioneTessera::class, NotificaAdminNuovaSottoscrizione::class);
        Event::listen(TrasfertaPrenotata::class, NotificaAdminNuovaPrenotazione::class);*/
    }
}
