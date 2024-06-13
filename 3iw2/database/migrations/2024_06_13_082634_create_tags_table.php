<?php

use App\Models\Message;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('slug');
            $table->string('color', 6);
            $table->unique(['slug']);
        });

        Schema::create('message_tag', function (Blueprint $table) {
            $table->foreignIdFor(Message::class)->constrained();
            $table->foreignIdFor(Tag::class)->constrained();
            $table->unique(['message_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_tag');
        Schema::dropIfExists('tags');
    }
};
