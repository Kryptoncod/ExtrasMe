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
        $table->date('date_start');
        $table->time('date_start_time');
        $table->date('date_finish');
        $table->time('date_finish_time');
        $table->integer('duration');
        $table->integer('number_persons');
        $table->integer('salary');
        $table->string('language');
        $table->string('benefits');
        $table->string('requirements');
        $table->string('informations');
        $table->boolean('find');
        $table->boolean('finish');
        $table->boolean('open');
        $table->integer('professional_id')->unsigned();
        $table->foreign('professional_id')->references('id')
                ->on('professionals')
                ->onDelete('cascade');
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
        Schema::table('extras', function(Blueprint $table) {
            $table->dropForeign(['professional_id']);
        });
        Schema::drop('extras');
    }
}
