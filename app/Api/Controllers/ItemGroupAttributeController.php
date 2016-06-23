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

    public function __construct(ItemGroupAttribute $itemGroupAttribute) {
        $this->itemGroupAttribute = $itemGroupAttribute;
    }

    public function index(Request $request) {
        $limit = $request->get('limit');
        $offset = $request->get('offset');
        $condition = "";
        $items = $this->itemGroupAttribute->getList($condition, $limit, $offset);
        return $this->response->collection(
            $items, new ItemGroupAttributeTransformer()
        );
    }

    public function store(ItemGroupAttributeStoreRequest $request) {
        $fields = $request->all();
        $res = $this->itemGroupAttribute->store($fields);
        return $this->response->array($res);
    }

    public function show($id) {
        $res = null;
        if ($id = intval($id)) {
            $res = $this->itemGroupAttribute->getById($id);
        }
        if ($res) {
            return $this->response->item($res, new ItemGroupAttributeTransformer());
        } else {
            $this->response->error('NotFound.', 404);
        }
    }

    public function update($id, ItemGroupAttributeUpdateRequest $request) {
        $fields = $request->all();
        $res = $this->itemGroupAttribute->update($id, $fields);
        if ($res) {
            return $this->response->item($res, new ItemGroupAttributeTransformer());
        }
        $this->response->errorNotFound('Item not found.');
    }

    public function destroy($id) {
        if ($id = intval($id)) {
            $res = $this->itemGroupAttribute->remove($id);
        }
        if ($res) {
            return $this->response->array($res);
        } else {
            $this->response->errorNotFound('Item not found.');
        }
    }
}
