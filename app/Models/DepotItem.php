<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepotItem extends Model
{
    protected $fillable = ['depot_id', 'item_id', 'amount'];

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
