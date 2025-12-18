<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partits', function (Blueprint $table) {
            $table->id();

            // Relaciones
            // Como hay dos FK a la misma tabla 'equips', hay que especificar la tabla
            $table->foreignId('local_id')->constrained('equips')->onDelete('cascade');
            $table->foreignId('visitant_id')->constrained('equips')->onDelete('cascade');
            $table->foreignId('estadi_id')->constrained('estadis')->onDelete('cascade');

            $table->dateTime('data'); // Fecha y hora
            $table->integer('jornada');

            // Goles (pueden ser nulos si el partido no se ha jugado)
            $table->integer('gols_local')->nullable();
            $table->integer('gols_visitant')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};
