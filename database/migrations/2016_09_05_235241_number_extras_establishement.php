<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NumberExtrasEstablishement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('number_extras_establishement', function(Blueprint $table){
        $table->increments('id');
        $table->integer('number_extras');
        $table->integer('student_id')->unsigned();
        $table->foreign('student_id')->references('id')
                ->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        $table->integer('professional_id')->unsigned();
        $table->foreign('professional_id')->references('id')
                ->on('professionals')
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
        Schema::table('number_extras_establishement', function(Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['professional_id']);
        });
        Schema::drop('number_extras_establishement');
    }
}
