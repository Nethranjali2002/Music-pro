<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            // Add any other columns (genre, album, etc.) as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('songs');
    }
}