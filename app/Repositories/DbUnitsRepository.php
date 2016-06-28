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
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DbUnitsRepository extends BaseDbRepository implements  UnitsRepository
{
    protected function getModelName()
    {
        return Unit::class;
    }

	public function remove($id)
	{
		$unit = $this->model->find($id);
		
		if (!$unit) 
			throw new NotFoundHttpException(trans('validation.custom.unit.not_found'));

		if ($unit->items()->count()) 
			throw new ConflictHttpException(trans('validation.custom.unit.related_with_item'));

		if ($unit->item_attributes()->count())
			throw new ConflictHttpException(trans('validation.custom.unit.related_with_item_attributes'));

		return $this->model->destroy($id);
	}
}