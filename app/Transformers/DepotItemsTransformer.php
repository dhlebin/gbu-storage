<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * @SWG\Definition(
 *      definition="DepotItem",
 *      type="object",
 *      @SWG\Property(property="data", type="array", @SWG\Items(
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="depot_id", type="integer"),
 *              @SWG\Property(property="item_id", type="integer"),
 *              @SWG\Property(property="amount", type="number"),
 *              @SWG\Property(property="created_at", type="string", format="dateTime"),
 *              @SWG\Property(property="updated_at", type="string", format="dateTime"),
 *              @SWG\Property(property="deleted_at", type="string", format="dateTime")
 *	 		)
 *      )
 * )
 */

class DepotItemsTransformer extends TransformerAbstract {
    public function transform($model) {
        return $model->toArray();
    }
}
