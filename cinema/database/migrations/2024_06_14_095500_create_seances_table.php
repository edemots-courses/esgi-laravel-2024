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
        Schema::create('seances', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_film');
            $table->integer('id_salle');
            $table->integer('id_personne_ouvreur');
            $table->integer('id_personne_technicien');
            $table->integer('id_personne_menage');
            $table->dateTime('debut_seance');
            $table->dateTime('fin_seance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
