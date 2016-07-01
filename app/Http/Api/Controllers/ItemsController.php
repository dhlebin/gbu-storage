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
     *     )
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

    public function update($id, ItemsUpdateRequest $request)
    {
        $fields = $request->all();
        $res = $this->itemsRepo->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new ItemsTransformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

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
