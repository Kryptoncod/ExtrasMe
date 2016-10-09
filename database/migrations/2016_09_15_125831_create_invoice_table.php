<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function(Blueprint $table){
        $table->increments('id');
        $table->boolean('paid'); //0 pour no 1 pour yes
        $table->integer('number_announce');
        $table->integer('price');
        $table->integer('price_announce');
        $table->integer('type_payment'); //0 pour cash, 1 pour sogen, 2 pour transfer
        $table->integer('professional_id')->unsigned();
        $table->foreign('professional_id')->references('id')
                ->on('professionals')
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
        Schema::table('invoices', function(Blueprint $table) {
            $table->dropForeign(['professional_id']);
        });
        Schema::drop('invoices');
    }
}
