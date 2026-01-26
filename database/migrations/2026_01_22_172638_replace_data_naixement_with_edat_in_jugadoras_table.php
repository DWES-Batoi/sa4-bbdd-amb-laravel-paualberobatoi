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
        Schema::table('jugadoras', function (Blueprint $table) {
            $table->dropColumn('data_naixement');
            $table->integer('edat')->nullable()->after('posicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jugadoras', function (Blueprint $table) {
            $table->dropColumn('edat');
            $table->date('data_naixement')->nullable(); // Recuperamos como nullable por seguridad en rollback
        });
    }
};
