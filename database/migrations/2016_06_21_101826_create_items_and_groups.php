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
            $table->string('alias')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('group_id')->index();
            $table->boolean('is_available')->default(true)->index();

            $table->timestamps();
        });

        Schema::create('item_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_available')->default(true)->index();

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
