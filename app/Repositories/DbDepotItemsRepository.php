<?php namespace App\Repositories;

use App\Models\DepotItem;

class DbDepotItemsRepository extends BaseDbRepository
{
    public function getModelName()
    {
        return DepotItem::class;
    }
}