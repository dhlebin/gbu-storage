<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;
/**
 * @SWG\Definition(
 *      definition="Item",
 *      type="object",
 *      @SWG\Property(property="data", type="array", @SWG\Items(
     *      @SWG\Property(property="id", type="integer"),
     *      @SWG\Property(property="alias", type="string"),
     *      @SWG\Property(property="name", type="string"),
     *      @SWG\Property(property="description", type="string"),
     *      @SWG\Property(property="group_id", type="integer"),
     *      @SWG\Property(property="is_available", type="integer"),
     *      @SWG\Property(property="created_at", type="dateTime"),
     *      @SWG\Property(property="updated_at", type="dateTime"),
     *      @SWG\Property(property="unit_id", type="integer"))
 *      )
 * )
 *
 *
 */
class ItemsTransformer extends TransformerAbstract
{
    public function transform(Model $item) {
        return $item->toArray();
    }
}