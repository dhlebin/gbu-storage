<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository as BaseRepositoryInterface;
use App\Models\Item;

class BaseDbRepository implements BaseRepositoryInterface
{
    const ITEMS_ON_PAGE = 10;

    var $mainModel;

    public function getList($condition = [], $columns = ['*'])
    {
        return $this->mainModel->where($condition)->paginate(self::ITEMS_ON_PAGE, $columns);
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->mainModel->findOrFail($id, $columns);
    }

    public function remove($id)
    {
        return $this->mainModel->destroy($id);
    }

    public function update($id, $fields)
    {
        $item = $this->mainModel->find($id);
        if ($item) {
            $item->update($fields);
        }
        return $item;
    }

    public function store($fields)
    {
        $model = $this->mainModel->create($fields);
        return $model;
    }
}