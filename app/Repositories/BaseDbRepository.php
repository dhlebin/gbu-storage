<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository as BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseDbRepository implements BaseRepositoryInterface
{
    const ITEMS_ON_PAGE = 10;

    /** @var Model $modelName */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelName());
    }

    abstract protected function getModelName();

    public function getList($condition = [], $columns = ['*'])
    {
        return $this->model->paginate(self::ITEMS_ON_PAGE, $columns);
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function remove($id)
    {
        return $this->model->destroy($id);
    }

    public function update($id, $fields)
    {
        $item = $this->model->find($id);
        if ($item) {
            $item->update($fields);
        }
        return $item;
    }

    public function store($fields)
    {
        $model = $this->model->create($fields);
        return $model;
    }
}