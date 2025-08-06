<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tesseramento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo_tessera_id',
        'data_inizio',
        'data_fine',
        'stato',
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
