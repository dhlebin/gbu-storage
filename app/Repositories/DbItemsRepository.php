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

    public function getById($id, $columns = ['*'])
    {
        return $this->model->with('attributes')->find($id, $columns);
    }

    public function store($fields)
    {
        $attributes = array_pull($fields, 'attributes', []);
        $model = $this->model->create($fields);
        if(!empty($attributes)) {
            $model->saveAttributes($attributes);
        }
        return $model;
    }

    public function update($id, $fields)
    {
        $attributes = array_pull($fields, 'attributes', []);
        $model = $this->model->find($id);
        if ($model) {
            $model->update($fields);
            if(!empty($attributes)) {
                $model->saveAttributes($attributes);
            }
        }
        return $model;
    }
}