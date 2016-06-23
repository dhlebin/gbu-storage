<?php namespace App\Contracts\Repositories;
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 22.06.2016
 * Time: 15:26
 */

use Illuminate\Http\Request;

interface BaseRepository {

    public function getList($condition, $limit, $offset);

    public function remove($id);

    public function update($id, $fields);

    public function getById($id);

    public function store($fields);

}
