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
        Schema::table('tesseramenti', function (Blueprint $table) {
            $table->string('metodo_pagamento')->nullable()->after('stato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tesseramenti', function (Blueprint $table) {
            //
        });
    }
};
