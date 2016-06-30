<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepotOrganizationRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depot_organization_roles', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('depot_id')->index();
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('user_role_id')->nullable();
            $table->string('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('depot_organization_roles');
    }
}
