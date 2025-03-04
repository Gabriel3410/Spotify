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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id');
            $table->foreignId('album_id')->nullable();
            $table->text('title')->nullable();
            $table->time('duration')->nullable(); // Tempo de duração da música
            $table->string('genre', 100)->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->string('file_url', 255); //URL do arquivo da música
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
