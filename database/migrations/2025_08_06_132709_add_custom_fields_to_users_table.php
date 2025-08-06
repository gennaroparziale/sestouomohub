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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cognome')->after('name'); // <-- NUOVO
            $table->enum('sesso', ['M', 'F'])->nullable()->after('cognome'); // <-- NUOVO
            $table->string('telefono')->nullable()->after('sesso');
            $table->date('data_di_nascita')->nullable()->after('telefono');
            $table->string('luogo_di_nascita')->nullable()->after('data_di_nascita');
            $table->string('codice_fiscale')->unique()->nullable()->after('luogo_di_nascita');
            $table->string('ruolo')->default('Socio Ordinario')->after('codice_fiscale');
            $table->string('contatto_emergenza')->nullable()->after('ruolo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
