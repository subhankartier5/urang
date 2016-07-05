<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pick_up_req_id');
            $table->integer('user_id');
            $table->double('price', 15, 8);
            $table->string('items');
            $table->integer('quantity');
            //$table->integer('payment_type')->comment = "1-> card, 2->cod, 3->check_payment";
            $table->integer('payment_status')->comment = "1->paid, 0-> pending";
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
        Schema::drop('order_details');
    }
}
