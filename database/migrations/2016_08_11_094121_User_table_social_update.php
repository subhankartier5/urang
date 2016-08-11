<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTableSocialUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function($table) {
            $table->integer('social_id')->nullable();
            $table->string('social_network')->nullable();
            $table->string('social_network_name')->nullable();
            $table->string('address')->nullable()->change();
            $table->string('personal_ph')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
