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
            $table->foreign('extra_id')->references('id')->on('extras')
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
        Schema::drop('extras_students');
    }
}
