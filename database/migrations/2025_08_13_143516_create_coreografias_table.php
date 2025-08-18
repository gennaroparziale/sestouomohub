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
        Schema::create('coreografie', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // CORRETTO
            $table->text('descrizione_piano')->nullable();
            $table->foreignId('settore_id')->constrained('settori')->onDelete('cascade');
            $table->json('piano')->nullable();
            $table->date('data_evento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coreografias');
    }
};
