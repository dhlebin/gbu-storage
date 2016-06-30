<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ItemGroupsTransformer extends TransformerAbstract
{
    public function transform($item)
    {
       return array_except($item->toArray(), ['_lft', '_rgt']);
    }

}