<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->longText('address');
            $table->bigInteger('personal_ph');
            $table->bigInteger('cell_phone')->nullable();
            $table->bigInteger('off_phone')->nullable();
            $table->string('spcl_instructions')->nullable();
            $table->string('driving_instructions')->nullable();
            //$table->tinyInteger('payment_status')->comment = "1->paid , 0->pending";
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
        Schema::drop('user_details');
    }
}
