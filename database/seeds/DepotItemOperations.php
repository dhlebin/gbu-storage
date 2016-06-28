<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 28.06.2016
 * Time: 12:08
 */

use Illuminate\Database\Seeder;
use App\Models\DepotItemOperation;

class DepotItemOperationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DepotItemOperation::create([
            'item_id' => 1,
            'depot_id' => 2,
            'depot_item_id' => 1,
            'status' => 'in_progress'
        ]);

        DepotItemOperation::create([
            'item_id' => 2,
            'depot_id' => 4,
            'depot_item_id' => 7,
            'status' => 'completed'
        ]);

        DepotItemOperation::create([
            'item_id' => 3,
            'depot_id' => 1,
            'depot_item_id' => 5,
            'status' => 'rejected'
        ]);
    }
}
