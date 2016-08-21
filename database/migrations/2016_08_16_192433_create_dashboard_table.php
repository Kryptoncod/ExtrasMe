<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function(Blueprint $table){
        $table->increments('id');
        $table->integer('total_earned');
        $table->integer('total_hours');
        $table->integer('numbers_extras');
        $table->integer('level');
        $table->integer('numbers_establishement');
        $table->integer('student_id')->unsigned();
        $table->foreign('student_id')->references('id')
                ->on('students')
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
        Schema::table('dashboards', function(Blueprint $table) {
            $table->dropForeign(['student_id']);
        });
        Schema::drop('dashboards');
    }
}
