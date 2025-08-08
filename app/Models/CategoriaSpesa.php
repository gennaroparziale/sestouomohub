<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaSpesa extends Model
{
    use HasFactory;

    protected $table = 'categoria_spesas';

    protected $fillable = ['nome'];

    public function transazioni(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transazione::class);
    }
}
