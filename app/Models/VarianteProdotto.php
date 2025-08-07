<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VarianteProdotto extends Model
{
    use HasFactory;

    protected $table = 'varianti_prodotto';

    protected $fillable = [
        'prodotto_id',
        'nome',
        'prezzo',
        'quantita_disponibile',
        'attributi',
    ];

    protected $casts = [
        'prezzo' => 'decimal:2',
        'attributi' => 'array', // Laravel tratterà questo campo come un array, non testo!
    ];

    public function prodotto(): BelongsTo
    {
        return $this->belongsTo(Prodotto::class);
    }
}
