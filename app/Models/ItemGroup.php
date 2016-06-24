<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class ItemGroup extends Model
{
    use NodeTrait;

    protected $fillable = ['alias', 'name', 'description', 'is_available', 'parent_id'];

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
