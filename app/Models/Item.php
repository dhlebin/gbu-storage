<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ItemGroup;

class Item extends Model
{
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo(ItemGroup::class);
    }
}
