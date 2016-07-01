<?php

namespace App\Http\Api\Controllers;

use App\Contracts\Repositories\DepotItemOperationsRepository as DepotItemOperations;
use App\Http\Api\Requests\DepotItemOperation\StoreRequest;
use App\Http\Api\Requests\DepotItemOperation\UpdateRequest;
use App\Transformers\DepotItemOperationsTransformer;

class DepotItemOperationsController extends BaseController
{
    protected $repository;

    function __construct(DepotItemOperations $depot)
    {
        $this->repository = $depot;
    }

    /**
     * @SWG\Get(
     *     path="/depot_item_operations/",
     *     summary="Return all depot item operations with pagination",
     *     tags={"Depot item operation"},
     *     description="This is method for find all depot item operations",
     *     operationId="findAllDepotItems",
     *     @SWG\Parameter(
     *          description="Number of page",
     *          name="page",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/DepotItemOperation"
     *          )
     *     )
     * )
     */

    public function index() {
        $depotItemOp = $this->repository->getList();
        return $this->response->paginator($depotItemOp, new DepotItemOperationsTransformer());
    }

    public function store(StoreRequest $request) {
        $fields = $request->all();
        $res = $this->repository->store($fields);
        return $this->response->item($res, new DepotItemOperationsTransformer());
    }

    public function show($id) {
        $res = $this->depotItemOperations->getById($id);
        if ($res)
            return $this->response->item($res, new DepotItemOperationsTransformer());
        $this->response->errorNotFound();
    }

    public function update($id, UpdateRequest $request) {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res)
            return $this->response->item($res, new DepotItemOperationsTransformer());
        $this->response->errorNotFound('Record not found');
    }
}
