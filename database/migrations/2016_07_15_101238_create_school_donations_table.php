<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_donations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('neighborhood_id');
            $table->string('school_name');
            $table->string('image');
            $table->double('pending_money', 15, 8)->nullable();
            $table->double('total_money_gained', 15, 8)->nullable();
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
        Schema::drop('school_donations');
    }
}
