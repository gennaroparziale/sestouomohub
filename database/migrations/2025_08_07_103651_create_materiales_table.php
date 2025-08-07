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
        // Usiamo il nome 'materiali' che è più corretto in italiano
        Schema::create('materiali', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descrizione')->nullable();
            $table->enum('tipo', ['bandiera', 'striscione', 'tamburo', 'megafono', 'altro'])->default('altro');
            $table->unsignedInteger('quantita')->default(1);
            $table->enum('stato', ['disponibile', 'in sede', 'in trasferta', 'in riparazione', 'ritirato'])->default('disponibile');
            $table->foreignId('responsabile_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales');
    }
};
