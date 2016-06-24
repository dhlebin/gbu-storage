<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Item;

class ItemGroup extends Model
{
    use NodeTrait;

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
