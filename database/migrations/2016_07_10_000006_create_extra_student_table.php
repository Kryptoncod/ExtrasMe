<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras_students', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('extra_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('rate')->unsigned();
            $table->boolean('doing');
            $table->foreign('extra_id')->references('id')->on('extras')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->foreign('student_id')->references('id')->on('students')
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
        Schema::table('extras_students', function(Blueprint $table) {
            $table->dropForeign(['extra_id']);
        });
        Schema::table('extras_students', function(Blueprint $table) {
            $table->dropForeign(['student_id']);
        });
        Schema::drop('extras_students');
    }
}
