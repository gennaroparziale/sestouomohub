<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VotoUtente extends Model
{
    use HasFactory;

    protected $table = 'voti_utenti';

    protected $fillable = [
        'user_id',
        'sondaggio_id',
        'opzione_sondaggio_id',
    ];

    // Ogni voto appartiene a un utente
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Ogni voto appartiene a un sondaggio
    public function sondaggio(): BelongsTo
    {
        return $this->belongsTo(Sondaggio::class);
    }
}
