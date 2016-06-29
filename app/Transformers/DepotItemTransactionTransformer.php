<?php
/**
 * Created by PhpStorm.
 * User: fans
 * Date: 24.06.16
 * Time: 14:55
 */
namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class DepotItemTransactionTransformer extends TransformerAbstract
{
    public function transform($depotItemTransaction)
    {
        return [
            'id' => $depotItemTransaction->id,
            'depot_item_operation_id' => $depotItemTransaction->depot_item_operation_id,
            'operation' => $depotItemTransaction->operation,
            'status' => $depotItemTransaction->status,
            'delta' => $depotItemTransaction->delta,
            'date' => $depotItemTransaction->date,
            'user_id' => $depotItemTransaction->user_id,
        ];
    }
}