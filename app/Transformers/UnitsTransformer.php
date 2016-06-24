<?php
/**
 * Created by PhpStorm.
 * User: fans
 * Date: 24.06.16
 * Time: 14:55
 */
namespace App\Transformers;

use League\Fractal\TransformerAbstract;

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