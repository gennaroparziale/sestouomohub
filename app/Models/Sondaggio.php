<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sondaggio extends Model
{
    use HasFactory;

    protected $table = 'sondaggi';

    protected $fillable = [
        'domanda',
        'stato',
    ];

    // Un sondaggio ha molte opzioni di risposta
    public function opzioni(): HasMany
    {
        return $this->hasMany(OpzioneSondaggio::class);
    }

    // Un sondaggio riceve molti voti
    public function voti(): HasMany
    {
        return $this->hasMany(VotoUtente::class);
    }
}
