<?php

namespace App\Http\Api\Controllers;

use App\Contracts\Repositories\DepotItemTransactionsRepository as DepotItemTransaction;
use App\Http\Api\Requests\DepotItemTransaction\StoreRequest;
use App\Http\Api\Requests\DepotItemTransaction\UpdateRequest;
use App\Transformers\DepotItemTransactionTransformer;

class DepotItemTransactionsController extends BaseController
{
    protected $depotItemTransahctions;

    public function __construct(DepotItemTransaction $dit)
    {
        $this->depotItemTransactions = $dit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/depot_item_transactions/",
     *     summary="Return all depot items transactions with pagination",
     *     tags={"Depot item transaction"},
     *     description="This is method for find all depot item transactions",
     *     operationId="findAllDepotItemTransactions",
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
     *             ref="#/definitions/DepotItemTransaction"
     *          )
     *     )
     * )
     */
    public function index()
    {
        $depotIT = $this->depotItemTransactions->getList();
        return $this->response->paginator($depotIT, new DepotItemTransactionTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
     *     path="/depot_item_transactions/",
     *     summary="Create new depot item transaction",
     *     tags={"Depot item transaction"},
     *     description="This is method create new depot item transaction",
     *     operationId="storeDepotItemTransaction",
     *     @SWG\Parameter(
     *          description="ID of depot item operation",
     *          name="depot_item_operation_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Type of operation",
     *          name="operation",
     *          in="query",
     *          required=false,
     *          type="string",
     *          enum={"basic", "correction", "loss"}
     *     ),
     *     @SWG\Parameter(
     *          description="Status",
     *          name="status",
     *          in="query",
     *          required=false,
     *          type="string",
     *          enum={"hold", "accepted", "declined"}
     *     ),
     *     @SWG\Parameter(
                description="Delta",
     *          name="delta",
     *          in="query",
     *          required=true,
     *          type="number"
*          ),
     *     @SWG\Parameter(
                description="Date",
     *          name="date",
     *          in="query",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/DepotItemTransaction"
     *          )
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     )
     * )
     *
     */
    public function store(StoreRequest $request)
    {
        $fields = $request->all();
        $res = $this->depotItemTransactions->store($fields);
        return $this->response->item($res, new DepotItemTransactionTransformer())->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @SWG\Get(
     *     path="/depot_item_transactions/{id}",
     *     summary="Return one depot item transaction",
     *     tags={"Depot item transaction"},
     *     description="This is method for find one depot item transaction by ID",
     *     operationId="findDepotItemTransaction",
     *     @SWG\Parameter(
     *          description="ID of item",
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
     *             ref="#/definitions/DepotItemTransaction"
     *          )
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Item not found"
     *     ),
     * )
     */
    public function show($id)
    {
        $res = $this->depotItemTransactions->getById($id);
        if ($res) return $this->response->item($res, new DepotItemTransactionTransformer());

        $this->response->errorNotFound();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Put(
     *     path="/depot_item_transactions/{id}",
     *     summary="Update depot item transaction",
     *     tags={"Depot item transaction"},
     *     description="This is method update depot item transaction by ID",
     *     operationId="updateDepotItemTransaction",
     *     @SWG\Parameter(
     *          description="ID of depot item transaction",
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of depot item operation",
     *          name="depot_item_operation_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Type of operation",
     *          name="operation",
     *          in="query",
     *          required=false,
     *          type="string",
     *          enum={"basic", "correction", "loss"}
     *     ),
     *     @SWG\Parameter(
     *          description="Status",
     *          name="status",
     *          in="query",
     *          required=false,
     *          type="string",
     *          enum={"hold", "accepted", "declined"}
     *     ),
     *     @SWG\Parameter(
                description="Delta",
     *          name="delta",
     *          in="query",
     *          required=false,
     *          type="number"
     *          ),
     *     @SWG\Parameter(
                description="Date",
     *          name="date",
     *          in="query",
     *          required=false,
     *          type="string"
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
     *         response="404",
     *         description="Item not found"
     *     ),
     * )
     *
     */
    public function update($id, UpdateRequest $request)
    {
        $fields = $request->all();
        $res = $this->depotItemTransactions->update($id, $fields);
        if ($res) return $this->response->item($res, new DepotItemTransactionTransformer());

        $this->response->errorNotFound('Unit not found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Delete(
     *     path="/depot_item_transactions/{id}",
     *     summary="Remove depot item transaction by ID",
     *     tags={"Depot item transaction"},
     *     description="This is method remove depot item operation",
     *     operationId="destroyDepotItemTransaction",
     *     @SWG\Parameter(
     *          description="ID depot item transaction for remove",
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *          response=204,
     *          description="successful operation"
     *     ),
     *     @SWG\Response(
     *          response=400,
     *          description="bad request"
     *     )
     * )
     *
     */
    public function destroy($id)
    {
        $res = $this->depotItemTransactions->remove($id);
        if ($res)
            return $this->response->noContent();

        $this->response->errorBadRequest();
    }
}
