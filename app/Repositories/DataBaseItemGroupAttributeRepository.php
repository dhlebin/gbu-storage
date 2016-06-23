<?php namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 22.06.2016
 * Time: 9:22
 */
use Illuminate\Http\Request;
use App\Contracts\Repositories\ItemGroupAttributeRepository;
use App\Models\ItemGroupAttribute;

class DataBaseItemGroupAttributeRepository implements ItemGroupAttributeRepository {

    public $limit = 10;

    public $offset = 0;

    public function getList($condition, $limit, $offset)
    {
        if ($limit = intval($limit)) {
            $this->limit = $limit;
        }
        if ($offset = intval($offset)) {
            $this->offset = $offset;
        }
        return ItemGroupAttribute::skip($this->offset)->take($this->limit)->get();
    }

    public function getById($id)
    {
        return ItemGroupAttribute::find($id);
    }

    public function remove($id)
    {
        $res = null;
        $item = ItemGroupAttribute::find($id);
        if ($item) {
            $item->delete();
            $res = array('status' => 'success');
        }
        return $res;
    }

    public function update($id, $fields)
    {
        $item = ItemGroupAttribute::find($id);
        if ($item) {
            $item->update($fields);
            $item->save();
        }
        return $item;
    }

    public function store($fields) {
        $lastId = ItemGroupAttribute::create($fields)->id;
        return array('id' => $lastId);
    }
}
