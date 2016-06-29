<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ItemAttribute
 *
 * @mixin \Eloquent
 */
class ItemAttribute extends Model
{
    use SoftDeletes;

    /**
     * @todo add field group_id
     * @var array
     */
    protected $fillable = [
        'name',
        'alias',
        'type',
        'unit_id'
    ];

    protected $dates = ['deleted_at'];

    public function values()
    {
        return $this->hasMany(ItemAttributesValue::class, 'attribute_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->values()->delete();
        });
    }
    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

}
