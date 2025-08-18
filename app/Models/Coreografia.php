<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coreografia extends Model
{
    use HasFactory;

    protected $table = 'coreografie';

    protected $fillable = [
        'nome', // Assicurati che sia 'nome' e non 'nome_evento'
        'descrizione_piano',
        'settore_id',
        'piano',
        'data_evento',
    ];

    protected $casts = [
        'data_evento' => 'date',
        'piano' => 'array', // Importantissimo! Laravel tratterà questo campo come un array.
    ];

    public function settore(): BelongsTo
    {
        return $this->belongsTo(Settore::class);
    }
}
