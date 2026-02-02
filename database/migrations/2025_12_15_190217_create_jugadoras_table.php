<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jugadoras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equip_id')->constrained('equips')->onDelete('cascade');
            $table->string('nom');
            $table->string('posicio'); // ✅ AÑADIDO
            $table->date('data_naixement'); // ✅ AÑADIDO
            $table->integer('dorsal');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jugadoras');
    }
};