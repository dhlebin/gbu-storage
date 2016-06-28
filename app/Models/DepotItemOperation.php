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
        'delta',
        'opposite_operation_id'
    ];

}
