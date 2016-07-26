<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * @SWG\Definition(
 *      definition="ItemGroup",
 *      type="object",
 *      @SWG\Property(property="data", type="array", @SWG\Items(
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="alias", type="string"),
 *              @SWG\Property(property="name", type="string"),
 *              @SWG\Property(property="description", type="string"),
 *              @SWG\Property(property="is_available", type="boolean"),
 *              @SWG\Property(property="parent_id", type="integer"),
 *              @SWG\Property(property="depth", type="integer")
 *          )
 *      )
 * )
 */

class ItemGroupsTransformer extends TransformerAbstract
{
    public function transform($item)
    {
       return array_except($item->toArray(), ['_lft', '_rgt']);
    }

}