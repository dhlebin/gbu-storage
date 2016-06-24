<?php

namespace App\Contracts\Repositories;

interface BaseRepository
{

    public function getList($condition = [], $columns = ['*']);

    public function remove($id);

    public function update($id, $fields);

    public function getById($id, $columns = ['*']);

    public function store($fields);

}
