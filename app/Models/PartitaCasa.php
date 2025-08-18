<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartitaCasa extends Model
{
    use HasFactory;

    protected $table = 'partite_in_casa';

    protected $fillable = [
        'avversario',
        'data_ora_partita',
        'stagione',
        'note',
    ];

    protected $casts = [
        'data_ora_partita' => 'datetime',
    ];

    public function presenze()
    {
        return $this->morphMany(Presenza::class, 'presenziabile');
    }
}
