<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FavorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoris', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('type'); //0 fav pro pour les students, 1 fav student pour les pros
            $table->integer('professional_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->foreign('professional_id')->references('id')->on('professionals')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->foreign('student_id')->references('id')->on('students')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favoris', function(Blueprint $table) {
            $table->dropForeign(['professional_id']);
        });
        Schema::table('favoris', function(Blueprint $table) {
            $table->dropForeign(['student_id']);
        });
        Schema::drop('extras_students');
    }
}
