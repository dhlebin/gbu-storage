<?php namespace App\Http\Api\Controllers;

use App\Contracts\Repositories\ItemAttributesRepository as ItemAttributes;
use App\Http\Api\Requests\StoreItemAttributeRequest;
use App\Http\Api\Requests\UpdateItemAttributeRequest;
use App\Repositories\DbItemAttributesRepository;
use App\Transformers\ItemAttributeTransformer;

class ItemAttributesController extends BaseController
{
    /** @var DbItemAttributesRepository $itemAttributes */
    protected $itemAttributes;

    public function __construct(ItemAttributes $itemAttributes)
    {
        $this->itemAttributes = $itemAttributes;
    }

    /**
     * @SWG\Get(
     *     path="/item_attributes/",
     *     summary="Return all item attributes with pagination",
     *     tags={"Item attribute"},
     *     description="This is method for find all item attributes",
     *     operationId="findAllItemAttributes",
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
     *             ref="#/definitions/ItemAttribute"
     *          )
     *     )
     * )
     */

    public function index()
    {
        $items = $this->itemAttributes->getList();
        return $this->response->paginator($items, new ItemAttributeTransformer);
    }

    /**
     * @SWG\Post(
     *     path="/item_attributes/",
     *     summary="Create new item attributes",
     *     tags={"Item attribute"},
     *     description="This is method create new item attribute",
     *     operationId="storeItemAttribute",
     *     @SWG\Parameter(
     *          description="Name of item attribute",
     *          name="name",
     *          in="query",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Alias of organization",
     *          name="alias",
     *          in="query",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Type of item attribute",
     *          name="type",
     *          in="query",
     *          required=true,
     *          type="string",
     *          enum={"integer", "float", "string", "text", "boolean", "datetime"}
     *     ),
     *     @SWG\Parameter(
                description="ID of unit",
     *          name="unit_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *          ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/ItemAttribute"
     *          )
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     )
     * )
     */

    public function store(StoreItemAttributeRequest $request)
    {
        $fields = $request->all();
        $res = $this->itemAttributes->store($fields);
        return $this->response->item($res, new ItemAttributeTransformer)->setStatusCode(201);
    }

    /**
     * @SWG\Get(
     *     path="/item_attributes/{id}",
     *     summary="Return one item attribute",
     *     tags={"Item attribute"},
     *     description="This is method for find one item attribute by ID",
     *     operationId="findItemAttribute",
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
     *             ref="#/definitions/ItemAttribute"
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
        $item = $this->itemAttributes->getById($id);
        if(!$item) {
            $this->response->errorNotFound();
        }
        return $this->response->item($item, new ItemAttributeTransformer);
    }

    /**
     * @SWG\Put(
     *     path="/item_attributes/{id}",
     *     summary="Update item attribute",
     *     tags={"Item attribute"},
     *     description="This is method update depot organization role by ID",
     *     operationId="updateItemAttribute",
     *     @SWG\Parameter(
     *          description="ID of item attribute",
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Name of item attribute",
     *          name="name",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Alias of organization",
     *          name="alias",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Type of item attribute",
     *          name="type",
     *          in="query",
     *          required=false,
     *          type="string",
     *          enum={"integer", "float", "string", "text", "boolean", "datetime"}
     *     ),
     *     @SWG\Parameter(
                description="ID of unit",
     *          name="unit_id",
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
     *             ref="#/definitions/ItemAttribute"
     *          )
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Item not found"
     *     ),
     * )
     */

    public function update($id, UpdateItemAttributeRequest $request)
    {
        $fields = $request->all();
        $res = $this->itemAttributes->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new ItemAttributeTransformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

    /**
     * @SWG\Delete(
     *     path="/item_attributes/{id}",
     *     summary="Remove item attributes by ID",
     *     tags={"Item attribute"},
     *     description="This is method remove item attribute",
     *     operationId="destroyItemAttribute",
     *     @SWG\Parameter(
     *          description="ID item attribute for remove",
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
        $res = $this->itemAttributes->remove($id);
        if ($res) {
            return $this->response->noContent();
        } else {
            $this->response->errorBadRequest();
        }
    }
}
