<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 27.06.2016
 * Time: 16:08
 */

namespace App\Repositories;

use App\Contracts\Repositories\DepotItemOperationsRepository;
use App\Models\DepotItemOperation;

class DbDepotItemOperationsRepository extends BaseDbRepository implements  DepotItemOperationsRepository
{
    protected function getModelName()
    {
        return DepotItemOperation::class;
    }
}
