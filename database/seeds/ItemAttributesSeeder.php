<?php

use Illuminate\Database\Seeder;
use App\Models\ItemAttribute;

class ItemAttributesSeeder extends Seeder {

    public function run() {
        DB::table('item_attributes')->delete();
        ItemAttribute::create([
            'name' => 'Объем',
            'alias' => 'volume',
            'type' => 'float',
        ]);
    }

}
