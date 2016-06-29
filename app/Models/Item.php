<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Item
 *
 * @mixin \Eloquent
 */
class Item extends Model
{
    protected $fillable = ['alias', 'name', 'description', 'group_id', 'is_available'];

    public function group()
    {
        return $this->belongsTo(ItemGroup::class);
    }

    public function attributes()
    {
        return $this->hasMany(ItemAttributesValue::class)->with('attribute');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->attributes()->delete();
        });
    }

    public function saveAttributes($attributes)
    {
        foreach ($attributes as $value) {
            $model = ItemAttributesValue::where('item_id', $this->id)
                ->where('attribute_id', $value['id'])
                ->first() ?: new ItemAttributesValue;
            $model->fill(['attribute_id' => $value['id'], 'value' => $value['value']]);
            $this->attributes()->save($model);
        }
    }
}
