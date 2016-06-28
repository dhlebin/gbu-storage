<?php namespace App\Repositories;

use App\Contracts\Repositories\DepotsRepository;
use App\Models\Depot;

class DbDepotsRepository extends BaseDbRepository implements DepotsRepository
{
    protected function getModelName()
    {
        return Depot::class;
    }
}
