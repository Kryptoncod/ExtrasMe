<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras', function(Blueprint $table){
        $table->increments('id');
        $table->boolean('broadcast'); //1 pour last minute et 0 pour normal
        $table->string('type');
        $table->date('date');
        $table->integer('duration');
        $table->integer('salary');
        $table->string('benefits');
        $table->string('requirements');
        $table->string('informations');
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
        Schema::drop('extras');
    }
}
