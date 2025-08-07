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
        Schema::table('prodotti', function (Blueprint $table) {
            $table->decimal('prezzo', 8, 2)->nullable()->change();
            $table->unsignedInteger('quantita_disponibile')->default(0)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prodotti', function (Blueprint $table) {
            //
        });
    }
};
