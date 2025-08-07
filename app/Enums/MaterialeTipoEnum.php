<?php

namespace App\Enums;

enum MaterialeTipoEnum: string
{
    case BANDIERA = 'bandiera';
    case STRISCIONE = 'striscione';
    case TAMBURO = 'tamburo';
    case MEGAFONO = 'megafono';
    case TROMBETTA = 'trombetta';
    case ALTRO = 'altro';

    // Funzione extra per avere un'etichetta più bella da mostrare
    public function label(): string
    {
        return match ($this) {
            self::BANDIERA => 'Bandiera',
            self::STRISCIONE => 'Striscione',
            self::TAMBURO => 'Tamburo',
            self::TROMBETTA => 'Trombetta',
            self::MEGAFONO => 'Megafono',
            self::ALTRO => 'Altro',
        };
    }
}
