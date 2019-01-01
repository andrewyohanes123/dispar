<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('latitude');
            $table->string('longitude');
            $table->longText('description');
            $table->string('address');
            $table->unsignedInteger('site_type_id');
            $table->unsignedInteger('travel_type_id')->nullable();
            $table->timestamps();
        });

        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facility');
            $table->unsignedInteger('site_id');
            $table->timestamps();
        });
        
        Schema::create('travel_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('site_type_id');
            $table->timestamps();
        });
        
        Schema::create('site_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('site_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo');
            $table->unsignedInteger('site_id');
            $table->timestamps();
        });

        Schema::table('travel_types', function(Blueprint $table){
            $table->foreign('site_type_id')->references('id')->on('site_types');
        });

        Schema::table('site_pictures', function(Blueprint $table){
            $table->foreign('site_id')->references('id')->on('sites');
        });

        Schema::table('facilities', function(Blueprint $table){
            $table->foreign('site_id')->references('id')->on('sites');
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        Schema::table('banners', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
