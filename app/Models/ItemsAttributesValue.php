<?php

namespace App;

use App\Models\Item;
use App\Models\ItemAttribute;
use Illuminate\Database\Eloquent\Model;

class ItemsAttributesValue extends Model
{
    public $timestamps = false;

    protected $fillable = [];

    public function attribute()
    {
        return $this->belongsTo(ItemAttribute::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getValueAttribute()
    {
        return $this->toArray();
    }
}
