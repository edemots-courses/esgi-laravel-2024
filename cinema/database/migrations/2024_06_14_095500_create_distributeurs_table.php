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
        Schema::create('distributeurs', function (Blueprint $table) {
            $table->integer('id_distributeur', true);
            $table->string('nom');
            $table->string('telephone');
            $table->string('adresse')->nullable();
            $table->string('cpostal')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributeurs');
    }
};
