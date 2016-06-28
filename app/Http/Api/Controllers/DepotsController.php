<?php

namespace App\Http\Api\Controllers;

use App\Contracts\Repositories\DepotsRepository;
use App\Http\Api\Requests\StoreDepotRequest;
use App\Http\Api\Requests\UpdateDepotRequest;
use App\Repositories\DbDepotsRepository;
use App\Transformers\DepotTransformer;

class DepotsController extends BaseController
{
    /** @var DbDepotsRepository depots */
    protected $repository;

    public function __construct(DepotsRepository $depots)
    {
        $this->repository = $depots;
    }

    public function index()
    {
        $items = $this->repository->getList();
        return $this->response->paginator($items, new DepotTransformer);
    }

    public function store(StoreDepotRequest $request)
    {
        $fields = $request->all();
        $res = $this->repository->store($fields);
        return $this->response->item($res, new DepotTransformer)->setStatusCode(201);
    }

    public function show($id)
    {
        $item = $this->repository->getById($id);
        if(!$item) {
            $this->response->errorNotFound();
        }
        return $this->response->item($item, new DepotTransformer);
    }

    public function update($id, UpdateDepotRequest $request)
    {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new DepotTransformer);
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
