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
        Schema::create('voti_utenti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sondaggio_id')->constrained('sondaggi')->onDelete('cascade');
            $table->foreignId('opzione_sondaggio_id')->constrained('opzioni_sondaggio')->onDelete('cascade');
            $table->timestamps();

            // --- ECCO LA REGOLA! ---
            // Questa riga dice al database: "La combinazione di user_id e sondaggio_id
            // deve essere unica. Non puoi inserire due righe con la stessa coppia."
            $table->unique(['user_id', 'sondaggio_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voto_utentes');
    }
};
