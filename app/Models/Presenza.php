<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presenza extends Model
{
    use HasFactory;
    protected $table = 'presenze';
    protected $fillable = ['user_id', 'presenziabile_id', 'presenziabile_type', 'scansionato_da_user_id'];

    public function presenziabile() { return $this->morphTo(); }
    public function user() { return $this->belongsTo(User::class); }
    public function scanner() { return $this->belongsTo(User::class, 'scansionato_da_user_id'); }
}
