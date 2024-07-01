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
        Schema::create('forfaits', function (Blueprint $table) {
            $table->integer('id_forfait', true);
            $table->string('nom');
            $table->string('resum');
            $table->integer('prix');
            $table->integer('duree_jours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forfaits');
    }
};
