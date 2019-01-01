<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('site_id');
            $table->timestamps();
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('type_attribute_id');
            $table->unsignedInteger('site_id');
            $table->timestamps();
        });

        Schema::table('type_attributes', function(Blueprint $table){
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
        });

        Schema::table('attribute_values', function(Blueprint $table){
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
            $table->foreign('type_attribute_id')->references('id')->on('type_attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_attributes');
    }
}
