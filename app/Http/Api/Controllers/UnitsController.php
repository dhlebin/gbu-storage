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
     */
    public function destroy($id)
    {
        $res = $this->units->remove($id);
		if ($res)
			return $this->response->noContent();

		$this->response->errorBadRequest();
    }
}
