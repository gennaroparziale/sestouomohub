<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        // Comando magico di Laravel: prende tutte le notifiche non lette
        // dell'utente autenticato e le segna come lette.
        $request->user()->unreadNotifications->markAsRead();

        // Risponde alla chiamata senza ricaricare la pagina.
        return response()->noContent();
    }
}
