<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit
 *
 * @mixin \Eloquent
 */
class DepotItemTransaction extends Model
{
    /**
     * @todo add user_id
     * 
     * @var array
     */
	protected $fillable = [
        'depot_item_operation_id', 
        'operation', 
        'status', 
        'delta', 
        'date',
    ];
    
	public $timestamps = false;
}
