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
            $table->biginteger('artist_id')->unsigned();
            $table->string('title');
            $table->string('album_name');
            $table->enum('genre', ['rnb', 'country', 'classic', 'rock', 'jazz']);
            $table->foreign('artist_id', 'songs_artist_id_foreign')->references('id')->on('artists')->onDelete('cascade');
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
