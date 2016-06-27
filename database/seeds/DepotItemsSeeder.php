<?php

use App\Models\DepotItem;
use Illuminate\Database\Seeder;

class DepotItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('depot_items')->truncate();
        DepotItem::create([
            'depot_id' => 1,
            'item_id'  => 1,
            'amount'   => 12.5
        ]);
    }
}
