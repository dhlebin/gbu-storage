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
    protected $fillable = ['alias', 'name', 'description', 'group_id', 'is_available', 'unit_id'];

    public function group()
    {
        return $this->belongsTo(ItemGroup::class);
    }

	public function unit()
	{
		return $this->belongsTo('App\Models\Unit');
	}

    public function attributes()
    {
        return $this->hasMany(ItemAttributesValue::class)->with('attribute');
    }

    public function saveAttributes($attributes)
    {
        foreach ($attributes as $id => $value) {
            $model = ItemAttributesValue::where('item_id', $this->id)
                ->where('attribute_id', $id)
                ->first() ?: new ItemAttributesValue;
            $model->fill(['attribute_id' => $id, 'value' => $value]);
            $this->attributes()->save($model);
        }
    }
}
