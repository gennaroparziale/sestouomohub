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
        Schema::create('tesseramenti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_tessera_id')->constrained('tipo_tesseras')->onDelete('cascade');
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->enum('stato', ['pagato', 'non pagato', 'in attesa'])->default('non pagato');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tesseramenti');
    }
};
