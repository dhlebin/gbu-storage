<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsAttributesValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_attributes_values', function (Blueprint $table) {
            $table->integer('item_id');
            $table->integer('attribute_id');
            $table->integer('integer_value');
            $table->string('string_value');
            $table->text('text_value');
            $table->dateTime('datetime_value');
            $table->boolean('boolean_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_attributes_values');
    }
}
