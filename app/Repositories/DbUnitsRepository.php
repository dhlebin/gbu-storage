<?php
/**
 * Created by PhpStorm.
 * User: fans
 * Date: 24.06.16
 * Time: 16:00
 */

namespace App\Repositories;

use App\Contracts\Repositories\UnitsRepository;
use App\Models\Unit;

class DbUnitsRepository implements  UnitsRepository
{
	const ITEMS_ON_PAGE = 10;
	
	public function getList($condition = [], $columns = ['*'])
	{
		return Unit::paginate(self::ITEMS_ON_PAGE, $columns);
	}
	
	public function getById($id, $columns = ['*'])
	{
		return Unit::find($id, $columns);
	}
	
	public function remove($id)
	{
		return Unit::destroy($id);
	}
	
	public function update($id, $fields)
	{
		$unit = Unit::find($id);
		if ($unit) $unit->update($fields);
		
		return $unit;
	}
	
	public function store($fields)
	{
		$model = Unit::create($fields);
		
		return $model;
	}
}