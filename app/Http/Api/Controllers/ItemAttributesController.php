<?php namespace App\Http\Api\Controllers;

use App\Api\Requests\StoreItemAttributeRequest;
use App\Api\Requests\UpdateItemAttributeRequest;
use App\Contracts\Repositories\ItemAttributesRepository as ItemGroupAttribute;
use App\Repositories\DbItemAttributesRepository;
use App\Transformers\ItemAttributeTransformer;

class ItemAttributesController extends BaseController
{
    /** @var DbItemAttributesRepository itemGroupAttribute */
    protected $itemAttributes;

    public function __construct(ItemGroupAttribute $itemGroupAttribute)
    {

        $this->itemAttributes = $itemGroupAttribute;
    }

    public function index()
    {
        $items = $this->itemAttributes->getList();
        return $this->response->paginator($items, new ItemAttributeTransformer);
    }

    public function store(StoreItemAttributeRequest $request)
    {
        $fields = $request->all();
        $res = $this->itemAttributes->store($fields);
        return $this->response->item($res, new ItemAttributeTransformer)->setStatusCode(201);
    }

    public function show($id)
    {
        $item = $this->itemAttributes->getById($id);
        if(!$item) {
            $this->response->errorNotFound();
        }
        return $this->response->item($item, new ItemAttributeTransformer);
    }

    public function update($id, UpdateItemAttributeRequest $request)
    {
        $fields = $request->all();
        $res = $this->itemAttributes->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new ItemAttributeTransformer);
        }
        $this->response->errorNotFound('Item not found.');
    }

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
