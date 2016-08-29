<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('tag_line')->nullable();
            $table->longText('header')->nullable();
            $table->longText('tag_line_2')->nullable();
            $table->longText('tag_line_3')->nullable();
            $table->longText('tag_line_4')->nullable();
            $table->longText('head_setion')->nullable();
            $table->longText('contents')->nullable();
            $table->longText('head_section_2')->nullable();
            $table->longText('contents_2')->nullable();
            $table->string('image')->nullable();
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
        Schema::drop('index_contents');
    }
}
