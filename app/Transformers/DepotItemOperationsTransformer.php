<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 28.06.2016
 * Time: 13:22
 */

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class DepotItemOperationsTransformer extends TransformerAbstract {

    public function transform($item) {
        return [
            'id' => $item->id,
            'item_id' => $item->item_id,
            'depot_id' => $item->depot_id,
            'depot_item_id' => $item->depot_item_id,
            'status' => $item->status,
            'type' => $item->type,
            'opposite_operation_id' => $item->opposite_operation_id,
            'delta' => $item->delta
        ];
    }
}
