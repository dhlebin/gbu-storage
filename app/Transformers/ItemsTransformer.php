<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ItemsTransformer extends TransformerAbstract {

    public function transform($item) {
        return [
            'id' => $item->id,
            'alias' =>$item->alias,
            'name' => $item->name,
            'description' => $item->description,
        ];
    }

}