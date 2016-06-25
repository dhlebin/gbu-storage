<?php namespace App\Repositories;

use App\Contracts\Repositories\ItemAttributesRepository;
use App\Models\ItemAttribute;

class DbItemAttributesRepository extends BaseDbRepository implements ItemAttributesRepository
{
    protected function getModelName()
    {
        return ItemAttribute::class;
    }
}
