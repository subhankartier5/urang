<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_keys', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('login_id');
            $table->longText('transaction_key');
            $table->tinyInteger('mode')->comment = "1->live , 0->test";
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
        Schema::drop('payment_keys');
    }
}
