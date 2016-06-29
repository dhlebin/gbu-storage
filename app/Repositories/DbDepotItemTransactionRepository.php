<?php
/**
 * Created by PhpStorm.
 * User: fans
 * Date: 24.06.16
 * Time: 16:00
 */

namespace App\Repositories;

use App\Contracts\Repositories\DepotItemTransactionsRepository;
use App\Models\DepotItemTransaction;

class DbDepotItemTransactionRepository extends BaseDbRepository implements  DepotItemTransactionsRepository
{
    protected function getModelName()
    {
        return DepotItemTransaction::class;
    }
}