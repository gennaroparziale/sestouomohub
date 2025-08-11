<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Riga importante
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoTessera extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descrizione',
        'prezzo',
        'stagione',
        'attivo',
        'stripe_price_id',
    ];

    public function tesseramenti(): HasMany
    {
        return $this->hasMany(Tesseramento::class);
    }
}
