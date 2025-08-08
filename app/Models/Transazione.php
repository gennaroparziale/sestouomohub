<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
class Transazione extends Model
{
    use HasFactory;

    protected $table = 'transazioni';

    protected $fillable = [
        'data_transazione',
        'descrizione',
        'importo',
        'tipo',
        'categoria_spesa_id',
        'categoria',
        'note',
    ];

    protected $casts = [
        'data_transazione' => 'date',
        'importo' => 'decimal:2',
    ];
    // Aggiungi questa nuova funzione
    public function categoriaSpesa()
    {
        return $this->belongsTo(CategoriaSpesa::class);
    }
}
