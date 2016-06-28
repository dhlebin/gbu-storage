<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class DepotItemsTransformer extends TransformerAbstract {
    public function transform($model) {
        return $model->toArray();
    }
}
