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
        Schema::create('varianti_prodotto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodotto_id')->constrained('prodotti')->onDelete('cascade');
            $table->string('nome'); // Es. "Taglia S - Colore Nero"
            $table->decimal('prezzo', 8, 2);
            $table->integer('quantita_disponibile')->default(0);
            $table->json('attributi')->nullable(); // Qui salveremo {"taglia": "S", "colore": "Nero"}
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variante_prodottos');
    }
};
