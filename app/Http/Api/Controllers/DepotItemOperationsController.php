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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
     *     path="/depot_item_operations/",
     *     summary="Create new depot item operation",
     *     tags={"Depot item operation"},
     *     description="This is method create new depot item operation",
     *     operationId="storeDepotItemOperation",
     *     @SWG\Parameter(
     *          description="ID of item",
     *          name="item_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of depot item",
     *          name="depot_item_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of depot",
     *          name="depot_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Status",
     *          name="status",
     *          in="query",
     *          required=true,
     *          type="string",
     *          enum={"in_progress", "completed", "rejected"}
     *     ),
     *     @SWG\Parameter(
     *          description="Type",
     *          name="type",
     *          in="query",
     *          required=true,
     *          type="string",
     *          enum={"change", "move", "correct"}
     *     ),
     *     @SWG\Parameter(
     *          description="Opposite operation ID",
     *          name="opposite_operation_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/DepotItemOperation"
     *          )
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     )
     * )
     *
     */

    public function store(StoreRequest $request) {
        $fields = $request->all();
        $res = $this->repository->store($fields);
        return $this->response->item($res, new DepotItemOperationsTransformer());
    }

    /**
     * @SWG\Get(
     *     path="/depot_item_operations/{id}",
     *     summary="Return one depot item operations",
     *     tags={"Depot item operation"},
     *     description="This is method for find one unit by ID",
     *     operationId="findUnit",
     *     @SWG\Parameter(
     *          description="ID of depot item operation",
     *          name="id",
     *          in="path",
     *          required=true,
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
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Item not found"
     *     ),
     * )
     */
    public function show($id) {
        $res = $this->depotItemOperations->getById($id);
        if ($res)
            return $this->response->item($res, new DepotItemOperationsTransformer());
        $this->response->errorNotFound();
    }

    /**
     * @SWG\Put(
     *     path="/depot_item_operations/{id}",
     *     summary="Update unit",
     *     tags={"Depot item operation"},
     *     description="This is method update depot item operation by ID",
     *     operationId="updateDepotItemOperation",
     *     @SWG\Parameter(
     *          description="ID of depot item operation",
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of item",
     *          name="item_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of depot item",
     *          name="depot_item_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of depot",
     *          name="depot_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Status",
     *          name="status",
     *          in="query",
     *          required=false,
     *          type="string",
     *          enum={"in_progress", "completed", "rejected"}
     *     ),
     *     @SWG\Parameter(
     *          description="Type",
     *          name="type",
     *          in="query",
     *          required=false,
     *          type="string",
     *          enum={"change", "move", "correct"}
     *     ),
     *     @SWG\Parameter(
     *          description="Opposite operation ID",
     *          name="opposite_operation_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/DepotItemOperation"
     *          )
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     )
     * )
     */

    public function update($id, UpdateRequest $request) {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res)
            return $this->response->item($res, new DepotItemOperationsTransformer());
        $this->response->errorNotFound('Record not found');
    }
}
