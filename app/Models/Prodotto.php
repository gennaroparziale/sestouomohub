<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
    use HasFactory;

    protected $table = 'prodotti';

    protected $fillable = [
        'nome',
        'slug',
        'descrizione',
        'prezzo',
        'immagine',
        'quantita_disponibile',
        'is_visibile',
    ];

    protected $casts = [
        'prezzo' => 'decimal:2',
        'is_visibile' => 'boolean',
    ];

    public function varianti(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\VarianteProdotto::class);
    }
}
