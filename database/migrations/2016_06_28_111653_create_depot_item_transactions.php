<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepotItemTransactions extends Migration
{
    /**
     * Run the migrations.
     * @todo need add user_id
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depot_item_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('depot_item_operation_id');
            $table->enum('operation', ['basic', 'correction', 'loss'])->default('basic');
            $table->enum('status', ['hold', 'accepted', 'declined'])->default('hold');
            $table->decimal('delta', 30, 5);
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depot_item_transactions');
    }
}
