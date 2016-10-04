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
        $table->integer('zipcode');
        $table->string('state');
        $table->string('country');
        $table->string('address');
        $table->integer('group');
        $table->integer('user_id')->unsigned();
        $table->boolean('registration_done');
        $table->foreign('user_id')->references('id')
                ->on('users')
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
        Schema::table('students', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::drop('students');
    }
}
