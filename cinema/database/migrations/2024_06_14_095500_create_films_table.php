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
        Schema::create('films', function (Blueprint $table) {
            $table->integer('id_film', true)->index('id_film');
            $table->integer('id_genre')->nullable()->index('id_genre');
            $table->integer('id_distributeur')->nullable();
            $table->string('titre');
            $table->string('resum')->nullable();
            $table->date('date_debut_affiche')->nullable();
            $table->date('date_fin_affiche')->nullable();
            $table->integer('duree_minutes')->nullable();
            $table->integer('annee_production')->nullable();

            $table->primary(['id_film']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
