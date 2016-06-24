<?php

namespace App\Repositories;

use App\Contracts\Repositories\ItemsRepository as ItemsRepositoryInterface;
use App\Models\Item;

class DbItemsRepository extends BaseDbRepository implements ItemsRepositoryInterface
{
    public function getModelName()
    {
        return Item::class;
    }
}