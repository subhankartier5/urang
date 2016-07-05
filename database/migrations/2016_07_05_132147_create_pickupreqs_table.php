<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickupreqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickupreqs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('address');
            $table->string('pick_up_date');
            $table->string('pick_up_type')->comment = "1->fast_pickup , 0->detailed_pickup";
            $table->string('schedule');
            $table->string('delivary_type');
            $table->string('starch_type');
            $table->integer('need_bag')->comment = "1-> yes, 0-> no";
            $table->integer('door_man')->comment = "1-> yes, 0-> no";
            $table->longText('special_instructions')->nullable();
            $table->longText('driving_instructions')->nullable();
            $table->integer('payment_type')->comment = "1-> card, 2->cod, 3->check_payment";
            $table->integer('order_status')->comment= "1->order placed, 2->picked up, 3->processed, 4->delivered";
            $table->integer('is_emergency')->comment = "1-> yes , 0-> no";
            $table->string('client_type');
            $table->string('coupon')->nullable();
            $table->integer('wash_n_fold')->comment = "1->yes, 0-> no";
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
        Schema::drop('pickupreqs');
    }
}
