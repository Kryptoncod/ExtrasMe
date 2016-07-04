<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('students', function(Blueprint $table){
        $table->increments('id');
        $table->string('last_name');
        $table->string('first_name');
        $table->string('nationality');
        $table->string('school_year');
        $table->string('phone');
        $table->boolean('gender');
        $table->date('birthdate');
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
        Schema::drop('students');
    }
}
