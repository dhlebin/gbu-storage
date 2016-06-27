<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DepotItemOperation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depot_item_operations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unique()->index();
            $table->integer('depot_id')->unique()->index();
            $table->integer('depot_item_id')->unique()->index()->nullable();
            $table->enum('status', ['in_progress', 'completed', 'rejected'])->default('in_progress');
            $table->timestamps();
            $table->timestamp('date_closed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('depot_item_operations');
    }
}
