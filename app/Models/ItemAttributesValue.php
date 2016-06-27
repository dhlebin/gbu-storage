<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ItemsAttributesValue
 *
 * @property-read \App\Models\ItemAttribute $attribute
 * @property-read \App\Models\Item $item
 * @property-read mixed $value
 * @mixin \Eloquent
 */
class ItemAttributesValue extends Model
{
    public $timestamps = false;

    protected $fillable = ['item_id', 'attribute_id', 'value'];

    protected $hidden = [
        'integer_value', 'string_value', 'text_value', 'datetime_value', 'boolean_value', 'float_value'
    ];

    protected $appends = ['value'];

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
        $this->casts['value'] = $this->attribute->type;
        return $this->castAttribute('value', $this->{$this->attribute->type.'_value'});
    }

    public function setValueAttribute($value)
    {
        $this->{$this->attribute->type.'_value'} = $value;
    }
}
