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
      Schema::create('student', function(Blueprint $table){
        $table->increments('id');
        $table->string('last_name');
        $table->string('first_name');
        $table->string('nationality');
        $table->string('year');
        $table->string('phone');
        $table->string('email')->unique();
        $table->string('password');
        $table->boolean('gender');
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
        //
    }
}
