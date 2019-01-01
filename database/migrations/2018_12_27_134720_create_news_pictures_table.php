<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->unsignedInteger('news_id');
            $table->timestamps();
        });

        Schema::table('news_pictures', function(Blueprint $table){
            $table->foreign('news_id')->references('id')->on('news');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_pictures');
    }
}
