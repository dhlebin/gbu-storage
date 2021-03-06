<?php

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->truncate();
        Item::create([
            'alias' => 'gravel',
            'name' => 'Гравий',
            'description' => 'Гравий, не очень мелкий',
            'group_id' => 3,
            'unit_id' => 3
        ]);

        Item::create([
            'alias' => 'sand',
            'name' => 'Песок',
            'description' => 'Песок типично обычный',
            'group_id' => 3,
            'unit_id' => 3
        ]);

        Item::create([
            'alias' => 'marble',
            'name' => 'Мрамор',
            'description' => 'Мрамор как мрамор',
            'group_id' => 5,
            'unit_id' => 3
        ]);
    }
}
