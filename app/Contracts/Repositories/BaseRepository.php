<?php

namespace App\Contracts\Repositories;
/**
 * Created by PhpStorm.
 * User: fans
 * Date: 24.06.16
 * Time: 14:44
 */

use Illuminate\Http\Request;

interface BaseRepository
{
	public function getList($condition = [], $columns = ['*']);

	public function remove($id);

	public function update($id, $fields);

	public function getById($id, $columns = ['*']);
	
	public function store($fields);
}