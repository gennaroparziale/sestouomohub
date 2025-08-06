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
        Schema::create('tipo_tesseras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descrizione')->nullable();
            $table->decimal('prezzo', 8, 2);
            $table->string('stagione');
            $table->boolean('attivo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_tesseras');
    }
};
