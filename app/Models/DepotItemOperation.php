<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DepotItemOperation
 *
 * @mixin \Eloquent
 */

class DepotItemOperation extends Model
{
    protected $fillable = [
        'item_id',
        'depot_id',
        'depot_item_id',
        'status',
        'type',
        'opposite_operation_id'
    ];
    
    public function depotItemTransactions() 
    {
        return $this->hasMany(DepotItemTransaction::class);
    }
}
