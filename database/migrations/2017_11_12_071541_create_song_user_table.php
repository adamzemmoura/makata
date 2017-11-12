<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('songID');
            $table->integer('userID');
            $table->integer('plays');
            $table->boolean('isFavorite');
            $table->boolean('isDownloaded');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_user');
    }
}
