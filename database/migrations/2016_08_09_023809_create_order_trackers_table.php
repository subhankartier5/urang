<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pick_up_req_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('order_placed')->nullable();
            $table->string('picked_up_date')->nullable();
            $table->string('order_status')->nullable()->comment= "1->order placed, 2->picked up, 3->processed, 4->delivered";
            $table->string('expected_return_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('original_invoice')->nullable();
            $table->string('final_invoice')->nullable();
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
        Schema::drop('order_trackers');
    }
}
