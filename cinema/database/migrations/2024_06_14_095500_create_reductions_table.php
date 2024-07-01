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
        Schema::create('reductions', function (Blueprint $table) {
            $table->integer('id_reduction', true);
            $table->string('nom');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->integer('pourcentage_reduction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reductions');
    }
};
