<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class DepotOrganizationRoleTransformer extends TransformerAbstract {
    public function transform($model) {
        return $model->toArray();
    }
}
