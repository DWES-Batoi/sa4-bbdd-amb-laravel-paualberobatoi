<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            // Claves foráneas para los equipos y el estadio
            $table->foreignId('equip_local_id')->constrained('equips')->onDelete('cascade');
            $table->foreignId('equip_visitant_id')->constrained('equips')->onDelete('cascade');
            $table->foreignId('estadi_id')->constrained('estadis')->onDelete('cascade');
            
            $table->dateTime('data_partit');
            $table->integer('gols_local')->nullable();
            $table->integer('gols_visitant')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};