<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prenotazioni_trasferte', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('trasferta_id')->constrained('trasferte')->onDelete('cascade');
            $table->timestamps();

            // Un piccolo trucco da pro: aggiungiamo un vincolo di unicità.
            // Questo impedisce al database di accettare una prenotazione
            // dalla stessa persona per la stessa trasferta più di una volta.
            $table->unique(['user_id', 'trasferta_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prenotazione_trasfertas');
    }
};
