<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('author_name');
            // 1.
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users');
            // 2.
            // $table->foreignId('user_id')->nullable()->constrained();
            // 3.
            $table->foreignIdFor(User::class)->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // 1.
            // $table->dropForeign(['user_id']);
            // $table->dropColumn('user_id');
            // 2.
            // $table->dropConstrainedForeignId('user_id');
            // 3.
            $table->dropConstrainedForeignIdFor(User::class);
            $table->string('author_name', 30);
        });
    }
};
