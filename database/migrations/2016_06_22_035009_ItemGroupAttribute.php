<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemGroupAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_group_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias')->nullable();
            $table->string('name')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('group_id');
            $table->timestamps();
        });
        Schema::create('item_attribute', function(Blueprint $table) {
            $table->increments('item_id');
            $table->integer('item_group_attribute_id');
            $table->string('value')->nullable();
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
        Schema::drop('item_group_attribute');
    }
}
