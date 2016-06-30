<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\ItemGroup
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read \App\Models\ItemGroup $parent
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\ItemGroup[] $children
 * @property-write mixed $parent_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemGroup d()
 * @mixin \Eloquent
 */
class ItemGroup extends Model
{
    use NodeTrait;

    protected $fillable = ['alias', 'name', 'description', 'is_available', 'parent_id', 'item_attributes'];

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function itemAttributes()
    {
        return $this->belongsToMany(ItemAttribute::class, 'items_groups_attributes');
    }

    public static function boot()
    {
        static::saving(function($model) {
            if($model->item_attributes) {
                $model->itemAttributes()->sync($model->item_attributes);
            }
        });
    }
}
