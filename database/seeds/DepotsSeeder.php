<?php

use App\Models\Depot;
use Illuminate\Database\Seeder;

class DepotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('depots')->truncate();
        Depot::create([
            'name'                  => 'Склад',
            'description'           => 'Просто склад',
            'owner_organization_id' => 1
        ]);
    }
}
