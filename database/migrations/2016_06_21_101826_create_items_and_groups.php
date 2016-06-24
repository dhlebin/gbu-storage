<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateItemsAndGroups extends Migration
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
            $table->string('alias', 255);
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->integer('group_id');
            $table->boolean('is_available')->default(true);

            $table->unique('alias');
            $table->index('group_id');
            $table->index('is_available');
        });

        Schema::create('item_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 255);
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->boolean('is_available')->default(true);

            $table->unique('alias');
            $table->index('is_available');

            NestedSet::columns($table);
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
        Schema::drop('item_groups');
    }
}
