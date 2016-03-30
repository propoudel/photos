<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('publisher_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('color_id')->unsigned();
            $table->integer('file_type_id')->unsigned();
            $table->integer('media_type_id')->unsigned();
            $table->integer('orientation_id')->unsigned();
            $table->integer('size_id')->unsigned();
            $table->string('metaTitle')->nullable();
            $table->string('metaKeyword')->nullable();
            $table->text('metaDescription')->nullable();
            $table->tinyInteger('status')->unsigned();
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
        Schema::drop('items');
    }
}
