<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 23.06.2016
 * Time: 15:11
 */
use Illuminate\Database\Seeder;
use App\Models\ItemGroupAttribute;

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
