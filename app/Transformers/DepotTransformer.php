<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * @SWG\Definition(
 *      definition="Depot",
 *      type="object",
 *      @SWG\Property(property="data", type="array", @SWG\Items(
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="name", type="string"),
 *              @SWG\Property(property="description", type="string"),
 *              @SWG\Property(property="owner_organization_id", type="integer"),
 *              @SWG\Property(property="created_at", type="string", format="dateTime"),
 *              @SWG\Property(property="updated_at", type="string", format="dateTime"),
 *              @SWG\Property(property="deleted_at", type="string", format="dateTime")
 *          )
 *      )
 * )
 *
 *
 */

class DepotTransformer extends TransformerAbstract {
    public function transform($model) {
        return $model->toArray();
    }
}
