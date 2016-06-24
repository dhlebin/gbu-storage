<?php

namespace App\Models;

use App\ItemsAttributesValue;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['alias', 'name', 'description', 'group_id', 'is_available'];

    public function group()
    {
        return $this->belongsTo(ItemGroup::class);
    }

    public function attributes()
    {
        return $this->hasMany(ItemsAttributesValue::class);
    }
}
