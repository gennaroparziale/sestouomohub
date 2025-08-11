<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('transazioni', function (Blueprint $table) {
            $table->string('metodo_pagamento')->nullable()->after('categoria_spesa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transazioni', function (Blueprint $table) {
            //
        });
    }
};
