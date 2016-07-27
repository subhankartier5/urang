<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('page_heading')->nullable();
            $table->string('tags')->nullable();
            $table->longText('content')->nullable();
            $table->string('background_image')->nullable();
            $table->tinyInteger('identifier')->comment = "0->dry clean page , 1-> wash and fold, 2->corporate page, 3-> tailoring page, 4-> wet cleaning page";
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
        Schema::drop('cms');
    }
}
