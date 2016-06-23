<?php namespace App\Repositories;

/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 22.06.2016
 * Time: 9:22
 */
use App\Contracts\Repositories\ItemGroupAttributeRepository;
use App\Models\ItemGroupAttribute;

class DataBaseItemGroupAttributeRepository implements ItemGroupAttributeRepository
{
    const ITEMS_ON_PAGE = 10;

    public function getList($condition = [], $columns = ['*'])
    {
        return ItemGroupAttribute::paginate(self::ITEMS_ON_PAGE, $columns);
    }

    public function getById($id, $columns = ['*'])
    {
        return ItemGroupAttribute::find($id, $columns);
    }

    public function remove($id)
    {
        return ItemGroupAttribute::destroy($id);
    }

    public function update($id, $fields)
    {
        $item = ItemGroupAttribute::find($id);
        if ($item) {
            $item->update($fields);
        }
        return $item;
    }

    public function store($fields)
    {
        $model = ItemGroupAttribute::create($fields);
        return $model;
    }
}
