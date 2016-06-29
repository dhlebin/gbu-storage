<?php

use App\Models\DepotItemTransaction;
use Illuminate\Database\Seeder;

class DepotItemTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DepotItemTransaction::create([
            'depot_item_operation_id' => '2',
            'operation' => 'basic',
            'status' => 'hold',
            'delta' => 3,
            'date' => '27-06-2016'
        ]);

        DepotItemTransaction::create([
            'depot_item_operation_id' => '3',
            'operation' => 'basic',
            'status' => 'hold',
            'delta' => 4,
            'date' => '27-06-2016',
        ]);

        DepotItemTransaction::create([
            'depot_item_operation_id' => '4',
            'operation' => 'loss',
            'status' => 'hold',
            'delta' => 23.34,
            'date' => '27-06-2016',
        ]);

        return;
    }
}
