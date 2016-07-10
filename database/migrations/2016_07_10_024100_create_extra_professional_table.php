<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraProfessionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras_professionals', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('extra_id')->unsigned();
            $table->integer('professional_id')->unsigned();
            $table->foreign('extra_id')->references('id')->on('extras')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->foreign('professional_id')->references('id')->on('professionals')
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
        Schema::drop('extras_professionals');
    }
}
