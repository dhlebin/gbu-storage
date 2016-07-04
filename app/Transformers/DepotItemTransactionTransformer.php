<?php
/**
 * Created by PhpStorm.
 * User: fans
 * Date: 24.06.16
 * Time: 14:55
 */
namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * @SWG\Definition(
 *      definition="DepotItemTransaction",
 *      type="object",
 *      @SWG\Property(property="data", type="array", @SWG\Items(
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="depot_item_operation_id", type="integer"),
 *              @SWG\Property(property="operation", type="string"),
 *              @SWG\Property(property="status", type="string"),
 *              @SWG\Property(property="delta", type="number"),
 *              @SWG\Property(property="date", type="string", format="dateTime"),
 *              @SWG\Property(property="user_id", type="integer")
 *	 		)
 *      )
 * )
 */

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