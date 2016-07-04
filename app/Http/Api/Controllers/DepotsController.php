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

    /**
     * @SWG\Get(
     *     path="/depots/",
     *     summary="Return all depots with pagination",
     *     tags={"Depot"},
     *     description="This is method for find all depots",
     *     operationId="findAllDepots",
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
     *             ref="#/definitions/Depot"
     *          )
     *     )
     * )
     */
    public function index()
    {
        $items = $this->repository->getList();
        return $this->response->paginator($items, new DepotTransformer);
    }

    /**
     * @SWG\Post(
     *     path="/depots/",
     *     summary="Create new depot",
     *     tags={"Depot"},
     *     description="This is method create new depot",
     *     operationId="storeDepot",
     *     @SWG\Parameter(
     *          description="Name of depot",
     *          name="name",
     *          in="query",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="ID owner organization",
     *          name="owner_organization_id",
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
     *             ref="#/definitions/Unit"
     *          )
     *     )
     * )
     */

    public function store(StoreDepotRequest $request)
    {
        $fields = $request->all();
        $res = $this->repository->store($fields);
        return $this->response->item($res, new DepotTransformer)->setStatusCode(201);
    }

    /**
     * @SWG\Get(
     *     path="/depots/{id}",
     *     summary="Return one depot",
     *     tags={"Depot"},
     *     description="This is method for find one depot by ID",
     *     operationId="findDepot",
     *     @SWG\Parameter(
     *          description="ID of depot",
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
     *             ref="#/definitions/Depot"
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
        if(!$item) {
            $this->response->errorNotFound();
        }
        return $this->response->item($item, new DepotTransformer);
    }

    /**
     * @SWG\Put(
     *     path="/depots/{id}",
     *     summary="Update depot",
     *     tags={"Depot"},
     *     description="This is method update depot by ID",
     *     operationId="updateDepot",
     *     @SWG\Parameter(
     *          description="ID of depot",
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Name of depot",
     *          name="name",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Owner organization of depot",
     *          name="owner_organization_id",
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
     *             ref="#/definitions/Depot"
     *          )
     *     )
     * )
     */

    public function update($id, UpdateDepotRequest $request)
    {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new DepotTransformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

    /**
     * @SWG\Delete(
     *     path="/depots/{id}",
     *     summary="Remove depot by ID",
     *     tags={"Depot"},
     *     description="This is method remove depot",
     *     operationId="destroyDepot",
     *     @SWG\Parameter(
     *          description="ID depot for remove",
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
