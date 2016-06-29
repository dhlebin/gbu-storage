<?php namespace App\Repositories;

use App\Contracts\Repositories\DepotOrganizationRolesRepository;
use App\Models\DepotOrganizationRole;

class DbDepotOrganizationRolesRepository extends BaseDbRepository implements DepotOrganizationRolesRepository
{
    protected function getModelName()
    {
        return DepotOrganizationRole::class;
    }
}