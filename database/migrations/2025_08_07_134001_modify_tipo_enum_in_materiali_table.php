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
        Schema::table('materiali', function (Blueprint $table) {
            // Ridefiniamo l'intera colonna con la nuova lista di opzioni
            $table->enum('tipo', [
                'bandiera',
                'striscione',
                'tamburo',
                'megafono',
                'altro',
                'trombetta' // <-- La nuova opzione
                // Aggiungi qui altre opzioni se vuoi
            ])->default('altro')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materiali', function (Blueprint $table) {
            //
        });
    }
};
