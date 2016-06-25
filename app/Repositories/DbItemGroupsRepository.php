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
}