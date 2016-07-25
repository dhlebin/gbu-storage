<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\ItemsUpdateRequest;
use App\Http\Api\Requests\ItemsStoreRequest;

use App\Contracts\Repositories\ItemsRepository;
use App\Transformers\ItemsTransformer;

class ItemsController extends BaseController
{
    public function __construct(ItemsRepository $itemsRepo)
    {
        $this->itemsRepo = $itemsRepo;
    }

    /**
     * @SWG\Get(
     *     path="/items",
     *     summary="Return all items with pagination",
     *     tags={"Item"},
     *     description="This is method for find all items",
     *     operationId="findAllItems",
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
     *             ref="#/definitions/Item"
     *          )
     *     )
     * )
     */

    public function index()
    {
        $items = $this->itemsRepo->getList();
        return $this->response->paginator($items, new ItemsTransformer);
    }

    /**
     * @SWG\Post(
     *     path="/items/",
     *     summary="Create new item",
     *     tags={"Item"},
     *     description="This is method create new item",
     *     operationId="storeItem",
     *     @SWG\Parameter(
     *          description="Name of item",
     *          name="name",
     *          in="query",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Alias of item",
     *          name="alias",
     *          in="query",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="ID group of item (exists)",
     *          name="group_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="-",
     *          name="is_available",
     *          in="query",
     *          required=true,
     *          type="string",
     *          enum={"0","1"}
     *     ),
     *     @SWG\Parameter(
     *          description="-",
     *          name="attributes.*.id",
     *          in="body",
     *          required=true,
     *          schema=@SWG\Schema(
     *             title="data",
     *             type="Array"
     *          )
     *     ),
     *     @SWG\Parameter(
     *          description="-",
     *          name="attributes.*.value",
     *          in="body",
     *          required=true,
     *          schema=@SWG\Schema(
     *             title="data",
     *             type="Array"
     *          )
     *     ),
     *     @SWG\Parameter(
     *          description="Unit id",
     *          name="unit_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/Item"
     *          )
     *     )
     * )
     */
    public function store(ItemsStoreRequest $request)
    {
        $fields = $request->all();
        $res = $this->itemsRepo->store($fields);
        return $this->response->item($res, new ItemsTransformer)->setStatusCode(201);
    }

    /**
     * @SWG\Get(
     *     path="/items/{id}",
     *     summary="Return one item",
     *     tags={"Item"},
     *     description="This is method for find one item by ID",
     *     operationId="findItem",
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
     *             ref="#/definitions/Item"
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
        $item = $this->itemsRepo->getById($id);
        if ($item) {
            return $this->response->item($item, new ItemsTransformer);
        }
        $this->response->errorNotFound();
    }

    /**
     * @SWG\Put(
     *     path="/items/{id}",
     *     summary="Return one item",
     *     tags={"Item"},
     *     description="This is method for update field in item by ID",
     *     operationId="updateItem",
     *     @SWG\Parameter(
     *          description="Name of item",
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Name of item",
     *          name="name",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Alias of item",
     *          name="alias",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="ID group of item (exists)",
     *          name="group_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="-",
     *          name="is_available",
     *          in="query",
     *          required=false,
     *          type="string",
     *          enum={"0","1"}
     *     ),
     *     @SWG\Parameter(
     *          description="Unit id",
     *          name="unit_id",
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
     *             ref="#/definitions/Item"
     *          )
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Item not found"
     *     )
     * )
     */

    public function update($id, ItemsUpdateRequest $request)
    {
        $fields = $request->all();
        $res = $this->itemsRepo->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new ItemsTransformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

    /**
     * @SWG\Delete(
     *     path="/items/{id}",
     *     summary="Remove item by ID",
     *     tags={"Item"},
     *     description="This is method remove item",
     *     operationId="destroyItem",
     *     @SWG\Parameter(
     *          description="ID item for remove",
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
     */

    public function destroy($id)
    {
        $res = $this->itemsRepo->remove($id);
        if ($res) {
            return $this->response->noContent();
        } else {
            $this->response->errorBadRequest();
        }
    }
}
