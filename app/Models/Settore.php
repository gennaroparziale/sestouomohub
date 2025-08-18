<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Settore extends Model
{
    use HasFactory;

    protected $table = 'settori';

    protected $fillable = [
        'nome',
        'numero_file',
        'posti_per_fila',
    ];

    public function coreografie()
    {
        return $this->hasMany(\App\Models\Coreografia::class);
    }
}

