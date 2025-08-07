<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpzioneSondaggio extends Model
{
    use HasFactory;

    protected $table = 'opzioni_sondaggio';

    protected $fillable = [
        'sondaggio_id',
        'testo_opzione',
        'voti',
    ];

    // Ogni opzione appartiene a un solo sondaggio
    public function sondaggio(): BelongsTo
    {
        return $this->belongsTo(Sondaggio::class);
    }
}
