<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * @SWG\Definition(
 *      definition="ItemAttribute",
 *      type="object",
 *      @SWG\Property(property="data", type="array", @SWG\Items(
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="name", type="string"),
 *              @SWG\Property(property="alias", type="string"),
 *              @SWG\Property(property="type", type="string"),
 *              @SWG\Property(property="created_at", type="string", format="dateTime"),
 *              @SWG\Property(property="updated_at", type="string", format="dateTime"),
 *              @SWG\Property(property="deleted_at", type="string", format="dateTime"),
 *              @SWG\Property(property="unit_id", type="integer")
 *          )
 *      )
 * )
 */

class ItemAttributeTransformer extends TransformerAbstract {
    public function transform($itemAttribute) {
        return $itemAttribute->toArray();
    }
}
