<?php

namespace App\Http\Api\Controllers;

use App\Contracts\Repositories\DepotItemsRepository;
use App\Http\Api\Requests\StoreDepotItemRequest;
use App\Http\Api\Requests\UpdateDepotItemRequest;
use App\Http\Requests;
use App\Repositories\DbDepotItemsRepository;
use App\Transformers\DepotItemsTransformer;

class DepotItemsController extends BaseController
{
    /** @var DbDepotItemsRepository */
    protected $repository;

    public function __construct(DepotItemsRepository $depotItems)
    {
        $this->repository = $depotItems;
    }

    public function index(DepotItemsTransformer $transformer)
    {
        $items = $this->repository->getList();

        return $this->response->paginator($items, $transformer);
    }

    public function store(StoreDepotItemRequest $request, DepotItemsTransformer $transformer)
    {
        $fields = $request->all();
        $res = $this->repository->store($fields);

        return $this->response->item($res, $transformer)->setStatusCode(201);
    }

    public function show($id, DepotItemsTransformer $transformer)
    {
        $item = $this->repository->getById($id);
        if (!$item) {
            $this->response->errorNotFound();
        }

        return $this->response->item($item, $transformer);
    }

    public function update($id, UpdateDepotItemRequest $request, DepotItemsTransformer $transformer)
    {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res) {
            return $this->response->item($res, $transformer);
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
