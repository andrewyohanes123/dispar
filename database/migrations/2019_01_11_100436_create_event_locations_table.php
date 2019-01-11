<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location');
            $table->string('latitude');
            $table->string('longitude');
            $table->unsignedInteger('event_calendar_id');
            $table->timestamps();
        });

        Schema::table('event_locations', function (Blueprint $table){
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
        Schema::dropIfExists('event_locations');
    }
}
