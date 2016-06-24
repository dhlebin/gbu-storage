<?php namespace App\Repositories;

use App\Contracts\Repositories\ItemAttributesRepository;
use App\Models\ItemAttribute;

class DbItemAttributesRepository implements ItemAttributesRepository
{
    const ITEMS_ON_PAGE = 10;

    public function getList($condition = [], $columns = ['*'])
    {
        return ItemAttribute::paginate(self::ITEMS_ON_PAGE, $columns);
    }

    public function getById($id, $columns = ['*'])
    {
        return ItemAttribute::find($id, $columns);
    }

    public function remove($id)
    {
        return ItemAttribute::destroy($id);
    }

    public function update($id, $fields)
    {
        $item = ItemAttribute::find($id);
        if ($item) {
            $item->update($fields);
        }
        return $item;
    }

    public function store($fields)
    {
        $model = ItemAttribute::create($fields);
        return $model;
    }
}
