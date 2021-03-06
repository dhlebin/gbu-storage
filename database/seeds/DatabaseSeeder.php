<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ItemGroupsSeeder::class);
        $this->call(ItemsSeeder::class);
        $this->call(ItemAttributesSeeder::class);
        $this->call(DepotsSeeder::class);
        $this->call(DepotItemsSeeder::class);
        $this->call(DepotItemOperationsSeeder::class);
        $this->call(DepotItemTransactionsSeeder::class);
        $this->call(DepotOrganizationRolesSeeder::class);
    }
}
