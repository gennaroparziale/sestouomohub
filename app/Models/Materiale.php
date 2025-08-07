<?php

namespace App\Models;

use App\Enums\MaterialeTipoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Materiale extends Model
{
    use HasFactory;

    protected $table = 'materiali';

    protected $casts = [
        'tipo' => MaterialeTipoEnum::class, // <-- 2. MODIFICA
    ];
    protected $fillable = [
        'nome',
        'descrizione',
        'tipo',
        'quantita',
        'stato',
        'responsabile_id',
        'note',
    ];

    public function responsabile(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsabile_id');
    }
}
