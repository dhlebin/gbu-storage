<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['alias', 'name', 'description', 'group_id', 'is_available'];

    public function group()
    {
        return $this->belongsTo(ItemGroup::class);
    }
}
