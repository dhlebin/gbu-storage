<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\DepotItemOperation\StoreRequest;
use App\Http\Api\Requests\DepotItemOperation\UpdateRequest;
use App\Transformers\DepotItemOperationsTransformer;
use App\Contracts\Repositories\DepotItemOperationsRepository as DepotItemOperations;

class DepotItemOperationsController extends BaseController
{
    protected $depotItemOperations;

    function __construct(DepotItemOperations $depot)
    {
        $this->depotItemOperations = $depot;
    }

    public function index() {
        $depotItemOp = $this->depotItemOperations->getList();
        return $this->response->paginator($depotItemOp, new DepotItemOperationsTransformer());
    }

    public function store(StoreRequest $request) {
        $fields = $request->all();
        $res = $this->depotItemOperations->store($fields);
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
        $res = $this->depotItemOperations->update($id, $fields);
        if ($res)
            return $this->response->item($res, new DepotItemOperationsTransformer());
        $this->response->errorNotFound('Record not found');
    }
}
