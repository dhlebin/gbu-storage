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

    protected $appends = ['delta'];

    protected $casts = [
        'delta' => 'float'
    ];
    
    public function depotItemTransactions() 
    {
        return $this->hasMany(DepotItemTransaction::class);
    }

    public function getDeltaAttribute()
    {
        return $this->depotItemTransactions()->groupBy('depot_item_operation_id')->sum('delta');
    }
}
