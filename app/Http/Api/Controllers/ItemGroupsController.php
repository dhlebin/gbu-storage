<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\StoreItemGroupRequest;
use App\Http\Api\Requests\UpdateItemGroupRequest;

use App\Contracts\Repositories\ItemGroupsRepository;
use App\Repositories\DbItemGroupsRepository;
use App\Transformers\ItemGroupsTransformer;

class ItemGroupsController extends BaseController
{
    /** @var DbItemGroupsRepository ItemGroupsRepository */
    protected $repository;
    
    public function __construct(ItemGroupsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @SWG\Get(
     *     path="/item_groups/",
     *     summary="Return all item groups with pagination",
     *     tags={"Item group"},
     *     description="This is method for find all item groups",
     *     operationId="findAllItemGroups",
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
     *             ref="#/definitions/ItemGroup"
     *          )
     *     )
     * )
     */

    public function index()
    {
        $items = $this->repository->getList();
        return $this->response->collection($items, new ItemGroupsTransformer);
    }

    /**
     * @SWG\Get(
     *     path="/item_groups/{id}/parent",
     *     summary="Return parent item group",
     *     tags={"Item group"},
     *     description="This is method for find parent item group",
     *     operationId="findParentItemGroup",
     *     @SWG\Parameter(
     *          description="Item group",
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
     *             ref="#/definitions/ItemGroup"
     *          )
     *     )
     * )
     */
    public function parent($id)
    {
        $item = $this->repository->parent($id);
        return $this->response->item($item, new ItemGroupsTransformer);
    }

    /**
     * @SWG\Get(
     *     path="/item_groups/{id}/children",
     *     summary="Return children item group",
     *     tags={"Item group"},
     *     description="This is method for find children item group",
     *     operationId="findChildrenItemGroup",
     *     @SWG\Parameter(
     *          description="Item group",
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
     *             ref="#/definitions/ItemGroup"
     *          )
     *     )
     * )
     */

    public function children($id)
    {
        $items = $this->repository->children($id);
        return $this->response->collection($items, new ItemGroupsTransformer);
    }

    /**
     * @SWG\Get(
     *     path="/item_groups/{id}/ancestors",
     *     summary="Return ancestors for item group",
     *     tags={"Item group"},
     *     description="This is method for find ancestors for item group",
     *     operationId="findAncestorsItemGroup",
     *     @SWG\Parameter(
     *          description="Item group",
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
     *             ref="#/definitions/ItemGroup"
     *          )
     *     )
     * )
     */

    public function ancestors($id)
    {
        $items = $this->repository->ancestors($id);
        return $this->response->collection($items, new ItemGroupsTransformer);
    }

    /**
     * @SWG\Post(
     *     path="/itemgroups/",
     *     summary="Create new item group",
     *     tags={"Item group"},
     *     description="This is method create new item group",
     *     operationId="storeItemGroup",
     *     @SWG\Parameter(
     *          description="Name of item group",
     *          name="name",
     *          in="query",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Alias of item group",
     *          name="alias",
     *          in="query",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of user role",
     *          name="is_available",
     *          in="query",
     *          required=true,
     *          type="string",
     *          enum={"0","1"}
     *     ),
     *     @SWG\Parameter(
                description="Parent ID item group",
     *          name="parent_id",
     *          in="query",
     *          required=false,
     *          type="number"
     *     ),
     *     @SWG\Parameter(
                description="Array IDs item attributes",
     *          name="item_attributes",
     *          in="body",
     *          required=false,
     *          type="array",
     *          schema=@SWG\Schema(
     *              type="Array"
     *          )
     *     ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/ItemGroup"
     *          )
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     )
     * )
     */

    public function store(StoreItemGroupRequest $request)
    {
        $fields = $request->all();
        $res = $this->repository->store($fields);
        return $this->response->item($res, new ItemGroupsTransformer)->setStatusCode(201);
    }

    /**
     * @SWG\Get(
     *     path="/itemgroups/{id}",
     *     summary="Return one item group",
     *     tags={"Item group"},
     *     description="This is method for find one item group by ID",
     *     operationId="findItemGroup",
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
     *             ref="#/definitions/ItemGroup"
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
        $item = $this->repository->getById($id);
        return $this->response->item($item, new ItemGroupsTransformer);
    }

    /**
     * @SWG\Put(
     *     path="/itemgroups/{id}",
     *     summary="Update depot organization role",
     *     tags={"Depot organization role"},
     *     description="This is method update depot organization role by ID",
     *     operationId="updateDepotOrganizationRole",
     *     @SWG\Parameter(
     *          description="ID of item group",
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Name of item group",
     *          name="name",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Alias of item group",
     *          name="alias",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of user role",
     *          name="is_available",
     *          in="query",
     *          required=false,
     *          type="string",
     *          enum={"0","1"}
     *     ),
     *     @SWG\Parameter(
                description="Parent ID item group",
     *          name="parent_id",
     *          in="query",
     *          required=false,
     *          type="number"
     *     ),
     *     @SWG\Parameter(
                description="Array IDs item attributes",
     *          name="item_attributes",
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
     *             ref="#/definitions/ItemGroup"
     *          )
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Item not found"
     *     ),
     * )
     */
    public function update($id, UpdateItemGroupRequest $request)
    {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new ItemGroupsTransformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

    /**
     * @SWG\Delete(
     *     path="/itemgroups/{id}",
     *     summary="Remove item group by ID",
     *     tags={"Item group"},
     *     description="This is method remove item group",
     *     operationId="destroyItemGroup",
     *     @SWG\Parameter(
     *          description="ID item group for remove",
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
        $res = $this->repository->remove($id);
        if ($res) {
            return $this->response->noContent();
        } else {
            $this->response->errorBadRequest();
        }
    }
}
