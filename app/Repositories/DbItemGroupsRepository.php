<?php

namespace App\Repositories;

use App\Contracts\Repositories\ItemGroupsRepository as ItemGroupsRepositoryInterface;
use App\Models\ItemGroup;

class DbItemGroupsRepository extends BaseDbRepository implements ItemGroupsRepositoryInterface
{
    public function getList($condition = [], $columns = ['*'])
    {
        return $this->model->withDepth()->get()->toFlatTree();
    }

    public function parent($id)
    {
        return $this->model->findOrFail($id)->parent()->get()->first();
    }

    public function children($id)
    {
        return $this->model->where(['parent_id' => $id])->get()->toFlatTree();
    }

    public function ancestors($id)
    {
        return $this->model->findOrFail($id)->ancestors()->get();
    }

    protected function getModelName()
    {
        return ItemGroup::class;
    }

    public function store($fields)
    {
        if(($model = parent::store($fields)) && isset($fields['item_attributes'])) {
            $model->saveAttributes($fields['item_attributes']);
        }

        return $model;
    }

    public function update($id, $fields)
    {
        if(($model = parent::update($id, $fields)) && isset($fields['item_attributes'])) {
            $model->saveAttributes($fields['item_attributes']);
        }

        return $model;
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->with('itemAttributes')->find($id, $columns);
    }
}