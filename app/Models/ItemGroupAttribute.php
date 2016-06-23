<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemGroupAttribute extends Model
{
    use SoftDeletes;

    protected $table = 'item_group_attribute';

    protected $fillable = ['name', 'alias', 'unit_id', 'group_id'];

    protected $dates = ['deleted_at'];


}
