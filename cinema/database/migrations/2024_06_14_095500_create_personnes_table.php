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
        Schema::create('personnes', function (Blueprint $table) {
            $table->integer('id_personne', true);
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('email');
            $table->string('adresse')->nullable();
            $table->string('cpostal');
            $table->string('ville');
            $table->string('pays');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnes');
    }
};
