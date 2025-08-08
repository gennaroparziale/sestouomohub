<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationComposer
{
    public function compose(View $view)
    {
        // Controlliamo se l'utente è loggato ed è un admin
        // per non eseguire questa logica inutilmente per gli utenti normali
        if (Auth::check() && Auth::user()->is_admin) {
            $user = Auth::user();

            // Prendiamo le ultime 5 notifiche non lette
            $unreadNotifications = $user->unreadNotifications()->take(5)->get();

            // Contiamo tutte le notifiche non lette per il badge
            $notificationsCount = $user->unreadNotifications()->count();

            // Passiamo le variabili alla vista
            $view->with('unreadNotifications', $unreadNotifications)
                ->with('notificationsCount', $notificationsCount);
        } else {
            // Se non è un admin, passiamo valori di default per evitare errori
            $view->with('unreadNotifications', collect())
                ->with('notificationsCount', 0);
        }
    }
}
