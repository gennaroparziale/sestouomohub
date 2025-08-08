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
        Schema::table('transazioni', function (Blueprint $table) {
            // Aggiungiamo la nuova colonna per il collegamento, dopo il campo 'tipo'
            $table->foreignId('categoria_spesa_id')->nullable()->after('tipo')->constrained('categoria_spesas')->onDelete('set null');

            // Rimuoviamo la vecchia colonna di testo 'categoria'
            $table->dropColumn('categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transazioni', function (Blueprint $table) {
            // Se annulliamo, ricreiamo la vecchia colonna...
            $table->string('categoria')->nullable()->after('tipo');

            // ...e rimuoviamo il nuovo collegamento.
            $table->dropForeign(['categoria_spesa_id']);
            $table->dropColumn('categoria_spesa_id');
        });
    }
};
