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
        Schema::create('trasferte', function (Blueprint $table) {
            $table->id();

            // Informazioni Evento
            $table->string('avversario');
            $table->dateTime('data_ora_partita');
            $table->string('luogo_partita');

            // Informazioni Logistiche
            $table->dateTime('data_ora_ritrovo');
            $table->string('luogo_ritrovo');
            $table->enum('mezzo_trasporto', ['auto', 'van', 'pullman', 'aereo', 'traghetto'])->default('pullman'); // <-- IL TUO CAMPO!
            $table->text('note_logistiche')->nullable();

            // Informazioni Costi e Posti
            $table->decimal('costo', 8, 2)->default(0);
            $table->unsignedInteger('posti_disponibili');

            // Informazioni Gestionali
            $table->enum('stato', ['pianificata', 'iscrizioni_aperte', 'completa', 'annullata', 'conclusa'])->default('pianificata');
            $table->dateTime('iscrizioni_chiuse_il')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trasfertas');
    }
};
