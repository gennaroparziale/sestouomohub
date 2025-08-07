<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coro extends Model
{
    use HasFactory;

    protected $table = 'cori';

    protected $fillable = [
        'titolo',
        'testo',
        'note',
    ];
}
