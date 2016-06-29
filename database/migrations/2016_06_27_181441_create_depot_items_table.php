<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepotItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depot_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('depot_id')->index();
            $table->unsignedInteger('item_id')->index();
            $table->decimal('amount', 30, 5);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('depot_items');
    }
}
