<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('professionals', function(Blueprint $table){
        $table->increments('id');
        $table->string('company_name');
        $table->string('category');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('phone');
        $table->integer('zipcode');
        $table->string('state');
        $table->string('country');
        $table->string('address');
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
        Schema::drop('professionals');
    }
}
