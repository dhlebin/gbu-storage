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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/depot_items/",
     *     summary="Return all depot items with pagination",
     *     tags={"Depot item"},
     *     description="This is method for find all depot items",
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
     *             ref="#/definitions/DepotItem"
     *          )
     *     )
     * )
     */
    public function index(DepotItemsTransformer $transformer)
    {
        $items = $this->repository->getList();

        return $this->response->paginator($items, $transformer);
    }

    /**
     * @SWG\Post(
     *     path="/depot_items/",
     *     summary="Create new depot item",
     *     tags={"Depot item"},
     *     description="This is method create new depot item",
     *     operationId="storeDepotItem",
     *     @SWG\Parameter(
     *          description="ID of depot",
     *          name="depot_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of item",
     *          name="item_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Amount value",
     *          name="amount",
     *          in="query",
     *          required=true,
     *          type="number"
     *     ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/DepotItem"
     *          )
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     )
     * )
     */

    public function store(StoreDepotItemRequest $request, DepotItemsTransformer $transformer)
    {
        $fields = $request->all();
        $res = $this->repository->store($fields);

        return $this->response->item($res, $transformer)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/depot_items/{id}",
     *     summary="Return one depot item",
     *     tags={"Depot item"},
     *     description="This is method for find one depot item by ID",
     *     operationId="findDepotItem",
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
     *             ref="#/definitions/DepotItem"
     *          )
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Item not found"
     *     ),
     * )
     *
     */

    public function show($id, DepotItemsTransformer $transformer)
    {
        $item = $this->repository->getById($id);
        if (!$item) {
            $this->response->errorNotFound();
        }

        return $this->response->item($item, $transformer);
    }

    /**
     * @SWG\Put(
     *     path="/depot_items/{id}",
     *     summary="Update depot item",
     *     tags={"Depot item"},
     *     description="This is method update depot item by ID",
     *     operationId="updateDepotItem",
     *     @SWG\Parameter(
     *          description="ID of depot item",
     *          name="id",
     *          in="path",
     *          required=true,
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
     *          description="ID of item",
     *          name="item_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Amount value",
     *          name="amount",
     *          in="query",
     *          required=false,
     *          type="number"
     *     ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/Unit"
     *          )
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Item not found"
     *     ),
     * )
     */

    public function update($id, UpdateDepotItemRequest $request, DepotItemsTransformer $transformer)
    {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res) {
            return $this->response->item($res, $transformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Delete(
     *     path="/depot_items/{id}",
     *     summary="Remove depot item by ID",
     *     tags={"Depot item"},
     *     description="This is method remove depot item",
     *     operationId="destroyDepotItem",
     *     @SWG\Parameter(
     *          description="ID depot item for remove",
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
        $res = $this->repository->remove($id);
        if ($res) {
            return $this->response->noContent();
        } else {
            $this->response->errorBadRequest();
        }
    }
}
