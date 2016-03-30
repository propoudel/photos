<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('bannerImage')->nullable();
            $table->tinyInteger('position')->ungigned();
            $table->string('metaTitle')->nullable();
            $table->string('metaKeyword')->nullable();
            $table->text('metaDescription')->nullable();
            $table->string('metaImage')->nullable();
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
        Schema::drop('sizes');
    }
}
