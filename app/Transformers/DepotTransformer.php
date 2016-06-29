<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class DepotTransformer extends TransformerAbstract {
    public function transform($model) {
        return $model->toArray();
    }
}
