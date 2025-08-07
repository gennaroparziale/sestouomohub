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
        Schema::create('cori', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->text('testo');
            $table->text('note')->nullable(); // Per istruzioni aggiuntive (es. "Si canta al 15° minuto")
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coros');
    }
};
