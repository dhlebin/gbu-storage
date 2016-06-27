<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ItemAttributeTransformer extends TransformerAbstract {
    public function transform($itemAttribute) {
        return $itemAttribute->toArray();
    }
}
