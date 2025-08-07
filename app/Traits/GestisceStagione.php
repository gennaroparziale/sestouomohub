<?php

namespace App\Traits;

trait GestisceStagione
{
    /**
     * Calcola la stagione sportiva corrente.
     * La nuova stagione inizia a Luglio (mese 7).
     */
    protected function getStagioneCorrente(): string
    {
        $anno = now()->year;
        $mese = now()->month;

        if ($mese >= 7) {
            return $anno . '/' . ($anno + 1);
        }

        return ($anno - 1) . '/' . $anno;
    }
}
