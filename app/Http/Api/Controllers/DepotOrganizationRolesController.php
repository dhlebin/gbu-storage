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

    public function index(DepotOrganizationRoleTransformer $transformer)
    {
        $items = $this->repository->getList();
        return $this->response->paginator($items, $transformer);
    }

    public function store(StoreRequest $request, DepotOrganizationRoleTransformer $transformer)
    {
        $fields = $request->all();
        $res = $this->repository->store($fields);
        return $this->response->item($res, $transformer)->setStatusCode(201);
    }

    public function show($id, DepotOrganizationRoleTransformer $transformer)
    {
        $item = $this->repository->getById($id);
        if(!$item) {
            $this->response->errorNotFound();
        }
        return $this->response->item($item, $transformer);
    }

    public function update($id, UpdateRequest $request, DepotOrganizationRoleTransformer $transformer)
    {
        $fields = $request->all();
        $res = $this->repository->update($id, $fields);
        if ($res) {
            return $this->response->item($res, $transformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

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
