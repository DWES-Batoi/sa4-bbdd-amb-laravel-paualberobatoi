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
        Schema::create('jugadoras', function (Blueprint $table) {
            $table->id();

            // Relación: Una jugadora pertenece a un Equipo
            // 'constrained' busca automáticamente la tabla 'equips' por el nombre
            $table->foreignId('equip_id')->constrained('equips')->onDelete('cascade');

            $table->string('nom');
            $table->date('data_naixement');
            $table->integer('dorsal');
            $table->string('foto')->nullable(); // Puede no tener foto al principio

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadoras');
    }
};
