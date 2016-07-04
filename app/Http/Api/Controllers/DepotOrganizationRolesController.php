<?php

namespace App\Http\Api\Controllers;

use App\Contracts\Repositories\DepotOrganizationRolesRepository;
use App\Http\Requests;
use App\Repositories\DbDepotOrganizationRolesRepository;
use App\Transformers\DepotOrganizationRoleTransformer;
use App\Http\Api\Requests\DepotOrganizationRole\StoreRequest;
use App\Http\Api\Requests\DepotOrganizationRole\UpdateRequest;

class DepotOrganizationRolesController extends BaseController
{
    /** @var DbDepotOrganizationRolesRepository $repository */
    protected $repository;

    public function __construct(DepotOrganizationRolesRepository $depotOrganizationRolesRepository)
    {
        $this->repository = $depotOrganizationRolesRepository;
    }

    /**
     * @SWG\Get(
     *     path="/depot_organization_roles/",
     *     summary="Return all depot organization roles with pagination",
     *     tags={"Depot organization role"},
     *     description="This is method for find all depot organization roles",
     *     operationId="findAllDepotOrganizationRoles",
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
     *             ref="#/definitions/DepotOrganizationRole"
     *          )
     *     )
     * )
     */

    public function index(DepotOrganizationRoleTransformer $transformer)
    {
        $items = $this->repository->getList();
        return $this->response->paginator($items, $transformer);
    }

    /**
     * @SWG\Post(
     *     path="/depot_organization_roles/",
     *     summary="Create new depot organization role",
     *     tags={"Depot organization role"},
     *     description="This is method create new depot organization role",
     *     operationId="storeDepotOrganizationRole",
     *     @SWG\Parameter(
     *          description="ID of depot",
     *          name="depot_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of organization",
     *          name="organization_id",
     *          in="query",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of user role",
     *          name="user_role_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
                description="Role",
     *          name="role",
     *          in="query",
     *          required=true,
     *          type="string"
*          ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/DepotOrganizationRole"
     *          )
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     )
     * )
     */

    public function store(StoreRequest $request, DepotOrganizationRoleTransformer $transformer)
    {
        $fields = $request->all();
        $res = $this->repository->store($fields);
        return $this->response->item($res, $transformer)->setStatusCode(201);
    }

    /**
     * @SWG\Get(
     *     path="/depot_organization_roles/{id}",
     *     summary="Return one depot organization role",
     *     tags={"Depot organization role"},
     *     description="This is method for find one depot organization role by ID",
     *     operationId="findDepotOrganizationRole",
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
     *             ref="#/definitions/DepotOrganizationRole"
     *          )
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Item not found"
     *     ),
     * )
     */

    public function show($id, DepotOrganizationRoleTransformer $transformer)
    {
        $item = $this->repository->getById($id);
        if(!$item) {
            $this->response->errorNotFound();
        }
        return $this->response->item($item, $transformer);
    }

    /**
     * @SWG\Put(
     *     path="/depot_organization_roles/{id}",
     *     summary="Update depot organization role",
     *     tags={"Depot organization role"},
     *     description="This is method update depot organization role by ID",
     *     operationId="updateDepotOrganizationRole",
     *     @SWG\Parameter(
     *          description="ID of depot organization role",
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
     *          description="ID of organization",
     *          name="organization_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="ID of user role",
     *          name="user_role_id",
     *          in="query",
     *          required=false,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
                description="Role",
     *          name="role",
     *          in="query",
     *          required=false,
     *          type="string"
     *          ),
     *     @SWG\Response(
     *          response=201,
     *          description="successful operation",
     *          @SWG\Schema(
     *             title="data",
     *             type="object",
     *             ref="#/definitions/DepotOrganizationRole"
     *          )
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Item not found"
     *     ),
     * )
     */

    public function update($id, UpdateRequest $request, DepotOrganizationRoleTransformer $transformer)
    {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res) {
            return $this->response->item($res, $transformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

    /**
     * @SWG\Delete(
     *     path="/depot_organization_roles/{id}",
     *     summary="Remove depot organization role by ID",
     *     tags={"Depot organization role"},
     *     description="This is method remove depot organization role",
     *     operationId="destroyDepotOrganizationRole",
     *     @SWG\Parameter(
     *          description="ID depot organization role for remove",
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
