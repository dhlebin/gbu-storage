<?php

use App\Models\ItemGroup;
use Illuminate\Database\Seeder;

class ItemGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_groups')->truncate();
        ItemGroup::create([
            'alias' => 'nerudka',
            'name' => 'Нерудные материалы',
            'description' => 'Нерудные материалы',
            'parent_id' => 0
        ]);

        ItemGroup::create([
            'alias' => 'stuff',
            'name' => 'Оборудование',
            'description' => 'Двигатели, станки и прочее',
            'parent_id' => 0
        ]);

        ItemGroup::create([
            'alias' => 'rocks',
            'name' => 'Горные породы',
            'description' => 'Горные породы',
            'parent_id' => 1
        ]);

        ItemGroup::create([
            'alias' => 'amorphous',
            'name' => 'Аморфные вещества',
            'description' => 'Аморфные вещества',
            'parent_id' => 1
        ]);

        ItemGroup::create([
            'alias' => 'subamorphous',
            'name' => 'Подкатегория аморфных веществ',
            'description' => 'Подкатегория ага',
            'parent_id' => 4
        ]);

        ItemGroup::create([
            'alias' => 'minerals',
            'name' => 'Минералы',
            'description' => 'Минералы',
            'parent_id' => 1
        ]);

        ItemGroup::create([
            'alias' => 'crystals',
            'name' => 'Кристаллы',
            'description' => 'Кристаллы',
            'parent_id' => 1
        ]);
    }
}
