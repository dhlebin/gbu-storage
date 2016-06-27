<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeItemsAttributesValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_attributes_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('integer_value')->nullable()->index()->change();
            $table->string('string_value')->nullable()->index()->change();
            $table->text('text_value')->nullable()->change();
            $table->dateTime('datetime_value')->nullable()->index()->change();
            $table->boolean('boolean_value')->nullable()->index()->change();
            $table->decimal('float_value')->nullable()->index();
            $table->unique(['item_id', 'attribute_id'], 'item_attribute');
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
