<?php
/**
 * Created by PhpStorm.
 * User: fans
 * Date: 24.06.16
 * Time: 16:00
 */

namespace App\Repositories;

use App\Contracts\Repositories\UnitsRepository;
use App\Models\Unit;

class DbUnitsRepository extends BaseDbRepository implements  UnitsRepository
{
    protected function getModelName()
    {
        return Unit::class;
    }
}