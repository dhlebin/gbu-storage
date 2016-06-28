<?php

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Item;

class ItemToUnit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
			'name' => 'Метр',
			'designation' => 'м',
			'decimal_symbol_count' => '2',
			'min_value' => 0
		]);

		Unit::create([
			'name' => 'Тайская блудница',
			'designation' => 'т/б',
			'decimal_symbol_count' => 0,
			'min_value' => 2
		]);

		Unit::create([
			'name' => 'Антрактический пингвин',
			'designation' => 'а/п',
			'decimal_symbol_count' => 0,
			'min_value' => 0
		]);

		Item::create([
			'alias' => 'kom',
			'name' => 'Ком',
			'description' => 'Ком грязи, не очень мелкий',
			'group_id' => 3,
			'unit_id' => 2
		]);

		Item::create([
			'alias' => 'blin',
			'name' => 'Блин',
			'description' => 'First blin komom',
			'group_id' => 3,
			'unit_id' => 3
		]);
    }
}
	
