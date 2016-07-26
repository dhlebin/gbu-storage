<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\UnitsUpdateRequest;
use App\Http\Api\Requests\UnitsStoreRequest;
use App\Contracts\Repositories\UnitsRepository as Units;
use App\Transformers\UnitsTransformer;

class UnitsController extends BaseController
{
    protected $units;

    public function __construct(Units $units)
    {
        $this->units = $units;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/units/",
     *     summary="Return all units with pagination",
     *     tags={"Unit"},
     *     description="This is method for find all units",
     *     operationId="findAllUnits",
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
     *             ref="#/definitions/Unit"
     *          )
     *     )
     * )
     */
    public function index()
    {
        $units = $this->units->getList();
        return $this->response->paginator($units, new UnitsTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
     *     path="/units/",
     *     summary="Create new unit",
     *     tags={"Unit"},
     *     description="This is method create new unit",
     *     operationId="storeUnit",
     *     @SWG\Parameter(
     *          description="Name of unit",
     *          name="name",
     *          in="query",
     *          required=true,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Designation of unit",
     *          name="designation",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Count symbols",
     *          name="decimal_symbol_count",
     *          in="query",
     *          required=false,
     *          type="number"
     *     ),
     *     @SWG\Parameter(
     *          description="-",
     *          name="min_value",
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
     *          response=422,
     *          description="Unprocessable Entity"
     *     )
     * )
     *
     */
    public function store(UnitsStoreRequest $request)
    {
        $fields = $request->all();
        $res = $this->units->store($fields);
        return $this->response->item($res, new UnitsTransformer())->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/units/{id}",
     *     summary="Return one unit",
     *     tags={"Unit"},
     *     description="This is method for find one unit by ID",
     *     operationId="findUnit",
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
     *
     */
    public function show($id)
    {
        $res = $this->units->getById($id);
        if ($res) return $this->response->item($res, new UnitsTransformer);

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
     *     path="/units/{id}",
     *     summary="Update unit",
     *     tags={"Unit"},
     *     description="This is method update unit by ID",
     *     operationId="updateUnit",
     *     @SWG\Parameter(
     *          description="ID of unit",
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *          description="Name of unit",
     *          name="name",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Designation of unit",
     *          name="designation",
     *          in="query",
     *          required=false,
     *          type="string"
     *     ),
     *     @SWG\Parameter(
     *          description="Count symbols",
     *          name="decimal_symbol_count",
     *          in="query",
     *          required=false,
     *          type="number"
     *     ),
     *     @SWG\Parameter(
     *          description="-",
     *          name="min_value",
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
     *     )
     * )
     *
     */
    public function update($id, UnitsUpdateRequest $request)
    {
        $fields = $request->all();
        $res = $this->units->update($id, $fields);
        if ($res) return $this->response->item($res, new UnitsTransformer());

        $this->response->errorNotFound('Unit not found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @SWG\Delete(
     *     path="/units/{id}",
     *     summary="Remove unit by ID",
     *     tags={"Unit"},
     *     description="This is method remove unit",
     *     operationId="destroyUnit",
     *     @SWG\Parameter(
     *          description="ID unit for remove",
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
        $res = $this->units->remove($id);
        if ($res)
            return $this->response->noContent();

        $this->response->errorBadRequest();
    }
}
