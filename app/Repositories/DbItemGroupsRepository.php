<?php

namespace App\Repositories;

use App\Contracts\Repositories\ItemGroupsRepository as ItemGroupsRepositoryInterface;
use App\Models\ItemGroup;

class DbItemGroupsRepository extends BaseDbRepository implements ItemGroupsRepositoryInterface
{
    public function __construct(ItemGroup $model)
    {
        $this->mainModel = $model;
    }

    public function getList($condition = [], $columns = ['*'])
    {
        return $this->mainModel->get()->toFlatTree();
    }

    public function parent($id)
    {
        return $this->mainModel->findOrFail($id)->parent()->get()->first();
    }

    public function children($id)
    {
        return $this->mainModel->where(['parent_id'=>$id])->get()->toFlatTree();
    }

    public function ancestors($id)
    {
        return $this->mainModel->findOrFail($id)->ancestors()->get();
    }
}