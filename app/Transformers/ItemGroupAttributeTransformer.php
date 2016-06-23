<?php namespace App\Transformers;
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 23.06.2016
 * Time: 9:19
 */

use League\Fractal\TransformerAbstract;

class ItemGroupAttributeTransformer extends TransformerAbstract {

    public function transform($itemGroupAttribute) {
        return [
            'id' => $itemGroupAttribute->id,
            'name' => $itemGroupAttribute->name,
            'alias' =>$itemGroupAttribute->alias
        ];
    }

}
