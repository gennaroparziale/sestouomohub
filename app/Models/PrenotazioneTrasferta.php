<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrenotazioneTrasferta extends Model
{
    use HasFactory;

    protected $table = 'prenotazioni_trasferte';

    protected $fillable = [
        'user_id',
        'trasferta_id',
        'pagato', // <-- AGGIUNGI
    ];

    // Aggiungi questo nuovo array
    protected $casts = [
        'pagato' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trasferta(): BelongsTo
    {
        return $this->belongsTo(Trasferta::class);
    }
}
