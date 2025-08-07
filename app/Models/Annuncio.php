<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Annuncio extends Model
{
    use HasFactory;

    protected $table = 'annunci';

    protected $fillable = [
        'user_id',
        'titolo',
        'contenuto',
        'in_evidenza',
    ];

    protected $casts = [
        'in_evidenza' => 'boolean',
    ];

    public function autore(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
