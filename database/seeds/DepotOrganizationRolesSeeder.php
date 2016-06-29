<?php

use Illuminate\Database\Seeder;

class DepotOrganizationRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('depot_organization_roles')->truncate();
        \App\Models\DepotOrganizationRole::create([
            'depot_id'        => 1,
            'role'            => 'owner',
            'organization_id' => 1,
            'user_role_id'    => 1
        ]);
    }
}
