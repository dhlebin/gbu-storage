<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DepotItemOpAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depot_item_operations', function(Blueprint $table) {
            $table->enum('type', ['change', 'move', 'correct'])->addField();
            $table->decimal('delta', 30, 2)->addField();
            $table->integer('opposite_operation_id')->unique()->index()->nullable()->addField();
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
