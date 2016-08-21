<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function(Blueprint $table){
        $table->increments('id');
        $table->integer('student_id')->unsigned();
        $table->foreign('student_id')->references('id')
                ->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        $table->string('summary');
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
        Schema::table('cvs', function(Blueprint $table) {
            $table->dropForeign(['student_id']);
        });
        Schema::drop('cvs');
    }
}
