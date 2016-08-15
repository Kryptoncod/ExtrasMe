<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function(Blueprint $table){
        $table->increments('id');
        $table->string('title');
        $table->date('from_date');
        $table->date('to_date');
        $table->string('summary');
        $table->integer('cv_id')->unsigned();
        $table->foreign('cv_id')->references('id')
                ->on('cvs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::drop('experiences');
    }
}
