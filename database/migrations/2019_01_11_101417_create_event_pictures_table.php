<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('picture');
            $table->unsignedInteger('event_calendar_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        Schema::table('event_pictures', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('event_calendar_id')->references('id')->on('event_calendars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_pictures');
    }
}
