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
        Schema::create('settori', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedInteger('numero_file');
            $table->unsignedInteger('posti_per_fila');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settores');
    }
};
