<?php

namespace App\Repositories;

use App\Contracts\Repositories\ItemsRepository as ItemsRepositoryInterface;
use App\Item;

class ItemsRepositoryDatabase implements ItemsRepositoryInterface
{
    public function __construct(Item $itemModel)
    {
        $this->itemModel = $itemModel;
    }

    public function find($id)
    {
        return $this->itemModel->findOrFail($id);
    }

    public function search($data)
    {
        return $this->itemModel->all();
    }

    public function create($data)
    {
        
    }

    public function update($data)
    {

    }
}