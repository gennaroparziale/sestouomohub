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
        Schema::create('presenze', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // L'utente presente
            $table->morphs('presenziabile'); // La magia polimorfica! (per l'evento)
            $table->foreignId('scansionato_da_user_id')->nullable()->constrained('users')->onDelete('set null'); // L'admin che ha scansionato
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presenzas');
    }
};
