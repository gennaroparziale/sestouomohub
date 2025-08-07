<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'cognome',
        'sesso',
        'email',
        'password',
        'telefono',
        'data_di_nascita',
        'luogo_di_nascita',
        'codice_fiscale',
        'ruolo',
        'contatto_emergenza',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'data_di_nascita' => 'date',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Un utente può avere molti tesseramenti.
     */
    public function tesseramenti(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Tesseramento::class);
    }
    // Metodo per la prenotazione delle trasferte
    public function prenotazioniTrasferte(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PrenotazioneTrasferta::class);
    }

    public function materiali(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Materiale::class, 'responsabile_id');
    }
    public function annunci(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Annuncio::class, 'user_id');
    }
    public function votiSondaggi(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\VotoUtente::class);
    }
}
