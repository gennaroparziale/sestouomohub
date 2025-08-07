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
        Schema::table('trasferte', function (Blueprint $table) {
            $table->string('stagione')->after('luogo_partita');
        });
    }

    public function down(): void
    {
        Schema::table('trasferte', function (Blueprint $table) {
            $table->dropColumn('stagione');
        });
    }
};
