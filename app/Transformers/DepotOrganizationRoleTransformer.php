<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * @SWG\Definition(
 *      definition="DepotOrganizationRole",
 *      type="object",
 *      @SWG\Property(property="data", type="array", @SWG\Items(
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="depot_id", type="integer"),
 *              @SWG\Property(property="organization_id", type="integer"),
 *              @SWG\Property(property="user_role_id", type="integer"),
 *              @SWG\Property(property="role", type="string"),
 *              @SWG\Property(property="created_at", type="string", format="dateTime"),
 *              @SWG\Property(property="updated_at", type="string", format="dateTime")
 *          )
 *      )
 * )
 */

class DepotOrganizationRoleTransformer extends TransformerAbstract {
    public function transform($model) {
        return $model->toArray();
    }
}
