<?php
/**
 * Created by PhpStorm.
 * User: fans
 * Date: 24.06.16
 * Time: 16:00
 */

namespace App\Repositories;

use App\Contracts\Repositories\UnitsRepository;
use App\Models\Item;
use App\Models\Unit;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class DbUnitsRepository extends BaseDbRepository implements  UnitsRepository
{
    protected function getModelName()
    {
        return Unit::class;
    }

	public function remove($id)
	{
		$itemsCount = $this->model->find($id)->hasMany(Item::class)->count();
		if ($itemsCount == 0) return $this->model->destroy($id);

		throw new ConflictHttpException(trans('validation.custom.unit.related_with_item'));
	}
}