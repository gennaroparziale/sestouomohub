<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trasferta extends Model
{
    use HasFactory;

    /**
     * Diciamo esplicitamente a Laravel il nome della nostra tabella,
     * così non prova a indovinarlo.
     * @var string
     */
    protected $table = 'trasferte';

    /**
     * I campi che possono essere "riempiti in massa" tramite un form.
     * @var array<int, string>
     */
    protected $fillable = [
        'avversario',
        'data_ora_partita',
        'luogo_partita',
        'stagione', // <-- AGGIUNGI QUI
        'data_ora_ritrovo',
        'luogo_ritrovo',
        'mezzo_trasporto',
        'note_logistiche',
        'costo',
        'posti_disponibili',
        'stato',
        'iscrizioni_chiuse_il',
    ];

    /**
     * Insegniamo a Laravel come trattare alcuni tipi di dati speciali.
     * @var array<string, string>
     */
    protected $casts = [
        'data_ora_partita' => 'datetime',
        'data_ora_ritrovo' => 'datetime',
        'iscrizioni_chiuse_il' => 'datetime',
        'costo' => 'decimal:2',
    ];

    public function prenotazioni(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PrenotazioneTrasferta::class);
    }
}
