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
 *      definition="Unit",
 *      type="object",
 *      @SWG\Property(property="data", type="array", @SWG\Items(
	 *      @SWG\Property(property="id", type="integer"),
	 *      @SWG\Property(property="name", type="string"),
	 *      @SWG\Property(property="description", type="string"),
	 *      @SWG\Property(property="decimal_symbols_count", type="numeric")
 *	 		)
 *      )
 * )
 *
 *
 */

class UnitsTransformer extends TransformerAbstract
{
	public function transform($item)
	{
		return [
			'id' => $item->id,
			'name' => $item->name,
			'designation' => $item->designation,
			'decimal_symbols_count' => $item->decimal_symbols_count
		];
	}
}