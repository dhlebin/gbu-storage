<?php

use Illuminate\Database\Seeder;
use App\Models\ItemGroupAttribute;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('ItemGroupAttributeSeeder');
    }

}

class ItemGroupAttributeSeeder extends Seeder {

    public function run() {
        DB::table('item_group_attribute')->delete();
        ItemGroupAttribute::create([
            'name' => 'Главные материалы',
            'alias' => 'main material',
            'unit_id' => 1,
            'group_id' => 1
        ]);

        ItemGroupAttribute::create([
            'name' => 'Посредственные материалы',
            'alias' => 'second material',
            'unit_id' => 2,
            'group_id' => 1
        ]);

        ItemGroupAttribute::create([
            'name' => 'Рудные материалы',
            'alias' => 'material',
            'unit_id' => 5,
            'group_id' => 3
        ]);
    }

}

