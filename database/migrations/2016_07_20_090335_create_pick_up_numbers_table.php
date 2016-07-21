<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickUpNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_up_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('week_day')->nullable();
            $table->integer('saturday')->nullable();
            $table->integer('sunday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pick_up_numbers');
    }
}
