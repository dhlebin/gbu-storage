<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ItemGroupsTransformer extends TransformerAbstract
{
    public function transform($item)
    {
        return [
            'id' => $item->id,
            'alias' => $item->alias,
            'name' => $item->name,
            'description' => $item->description,
            'is_available' => $item->is_available,
            'parent_id' => $item->parent_id,
        ];
    }

}