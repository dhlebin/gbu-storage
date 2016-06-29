<?php

namespace App\Http\Api\Controllers;

use App\Contracts\Repositories\DepotItemTransactionsRepository as DepotItemTransaction;
use App\Http\Api\Requests\DepotItemTransaction\StoreRequest;
use App\Http\Api\Requests\DepotItemTransaction\UpdateRequest;
use App\Transformers\DepotItemTransactionTransformer;

class DepotItemTransactionsController extends BaseController
{
    protected $depotItemTransahctions;

    public function __construct(DepotItemTransaction $dit)
    {
        $this->depotItemTransactions = $dit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depotIT = $this->depotItemTransactions->getList();
        return $this->response->paginator($depotIT, new DepotItemTransactionTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $fields = $request->all();
        $res = $this->depotItemTransactions->store($fields);
        return $this->response->item($res, new DepotItemTransactionTransformer())->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = $this->depotItemTransactions->getById($id);
        if ($res) return $this->response->item($res, new DepotItemTransactionTransformer());

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
    public function update($id, UpdateRequest $request)
    {
        $fields = $request->all();
        $res = $this->depotItemTransactions->update($id, $fields);
        if ($res) return $this->response->item($res, new DepotItemTransactionTransformer());

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
        $res = $this->depotItemTransactions->remove($id);
        if ($res)
            return $this->response->noContent();

        $this->response->errorBadRequest();
    }
}
