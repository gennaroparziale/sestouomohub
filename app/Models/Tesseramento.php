<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Riga fondamentale
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tesseramento extends Model
{
    use HasFactory;
    protected $table = 'tesseramenti';
    protected $fillable = [
        'user_id',
        'tipo_tessera_id',
        'data_inizio',
        'data_fine',
        'stato',
        'metodo_pagamento',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tipoTessera(): BelongsTo
    {
        return $this->belongsTo(TipoTessera::class);
    }
}
