<?php namespace App\Repositories;

use App\Contracts\Repositories\DepotItemsRepository;
use App\Models\DepotItem;

class DbDepotItemsRepository extends BaseDbRepository implements DepotItemsRepository
{
    public function getModelName()
    {
        return DepotItem::class;
    }
}