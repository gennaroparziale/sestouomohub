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
        Schema::create('opzioni_sondaggio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sondaggio_id')->constrained('sondaggi')->onDelete('cascade');
            $table->string('testo_opzione');
            $table->unsignedInteger('voti')->default(0); // Per contare i voti
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opzione_sondaggios');
    }
};
