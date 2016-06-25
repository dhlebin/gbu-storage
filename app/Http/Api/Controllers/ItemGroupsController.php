<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\StoreItemGroupRequest;
use App\Http\Api\Requests\UpdateItemGroupRequest;

use App\Contracts\Repositories\ItemGroupsRepository;
use App\Repositories\DbItemGroupsRepository;
use App\Transformers\ItemGroupsTransformer;

class ItemGroupsController extends BaseController
{
    /** @var DbItemGroupsRepository ItemGroupsRepository */
    protected $repository;
    
    public function __construct(ItemGroupsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $items = $this->repository->getList();
        return $this->response->collection($items, new ItemGroupsTransformer);
    }

    public function parent($id)
    {
        $item = $this->repository->parent($id);
        return $this->response->item($item, new ItemGroupsTransformer);
    }

    public function children($id)
    {
        $items = $this->repository->children($id);
        return $this->response->collection($items, new ItemGroupsTransformer);
    }

    public function ancestors($id)
    {
        $items = $this->repository->ancestors($id);
        return $this->response->collection($items, new ItemGroupsTransformer);
    }

    public function store(StoreItemGroupRequest $request)
    {
        $fields = $request->all();
        $res = $this->repository->store($fields);
        return $this->response->item($res, new ItemGroupsTransformer)->setStatusCode(201);
    }

    public function show($id)
    {
        $item = $this->repository->getById($id);
        return $this->response->item($item, new ItemGroupsTransformer);
    }

    public function update($id, UpdateItemGroupRequest $request)
    {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new ItemGroupsTransformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

    public function destroy($id)
    {
        $res = $this->repository->remove($id);
        if ($res) {
            return $this->response->noContent();
        } else {
            $this->response->errorBadRequest();
        }
    }
}
