<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function(Blueprint $table){
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
        Schema::table('educations', function(Blueprint $table) {
            $table->dropForeign(['cv_id']);
        });
        Schema::drop('educations');
    }
}