<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){
        $table->increments('id');
        $table->string('email')->unique();
        $table->string('password');
        $table->boolean('type'); //0 pour student et 1 pour professional
        $table->boolean('newsletter')->default(false); //0 pour non et 1 pour oui
        $table->boolean('admin')->default(false);
        $table->rememberToken();
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
        Schema::drop('users');
    }
}
