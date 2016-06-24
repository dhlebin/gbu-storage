<?php

namespace App\Repositories;

use App\Contracts\Repositories\ItemsRepository as ItemsRepositoryInterface;
use App\Models\ItemGroup;

class DbItemGroupsRepository implements ItemsRepositoryInterface
{
    public function __construct(ItemGroup $itemGroupModel)
    {
        $this->itemGroupModel = $itemGroupModel;
    }

    public function find($id)
    {
        return $this->itemGroupModel->findOrFail($id);
    }

    public function search($data)
    {
    }

    public function create($data)
    {
        
    }

    public function update($data)
    {

    }

    public function parent($id)
    {

    }

    public function children($id)
    {

    }

    public function descendants($id)
    {

    }

    public function tree($id)
    {

    }
}