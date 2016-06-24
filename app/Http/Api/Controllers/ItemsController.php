<?php

namespace App\Http\Api\Controllers;

use App\Api\Requests\ItemsUpdateRequest;
use App\Api\Requests\ItemsStoreRequest;

use App\Contracts\Repositories\ItemsRepository;
use App\Transformers\ItemsTransformer;

class ItemsController extends BaseController
{
    public function __construct(ItemsRepository $itemsRepo)
    {
        $this->itemsRepo = $itemsRepo;
    }

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

    public function show($id)
    {
        $item = $this->itemsRepo->getById($id);
        return $this->response->item($item, new ItemsTransformer);
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
