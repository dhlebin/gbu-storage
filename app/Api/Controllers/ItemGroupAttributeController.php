<?php namespace App\Api\Controllers;

use App\Http\Requests\ItemGroupAttributeUpdateRequest;
use Illuminate\Http\Request;

use App\Http\Requests\ItemGroupAttributeStoreRequest;

use App\Contracts\Repositories\ItemGroupAttributeRepository as ItemGroupAttribute;
use App\Transformers\ItemGroupAttributeTransformer;

use Response;
use Validator;

class ItemGroupAttributeController extends BaseController
{
    //
    protected $itemGroupAttribute;

    public function __construct(ItemGroupAttribute $itemGroupAttribute)
    {
        $this->itemGroupAttribute = $itemGroupAttribute;
    }

    public function index()
    {
        $items = $this->itemGroupAttribute->getList();
        return $this->response->paginator($items, new ItemGroupAttributeTransformer);
    }

    public function store(ItemGroupAttributeStoreRequest $request)
    {
        $fields = $request->all();
        $res = $this->itemGroupAttribute->store($fields);
        return $this->response->item($res, new ItemGroupAttributeTransformer)->setStatusCode(201);
    }

    public function show($id)
    {
        $res = $this->itemGroupAttribute->getById($id);
        if ($res) {
            return $this->response->item($res, new ItemGroupAttributeTransformer);
        } else {
            $this->response->errorNotFound();
        }
    }

    public function update($id, ItemGroupAttributeUpdateRequest $request)
    {
        $fields = $request->all();
        $res = $this->itemGroupAttribute->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new ItemGroupAttributeTransformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

    public function destroy($id)
    {
        $res = $this->itemGroupAttribute->remove($id);
        if ($res) {
            return $this->response->noContent();
        } else {
            $this->response->errorBadRequest();
        }
    }
}
