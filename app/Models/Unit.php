<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
	protected $fillable = ['name', 'designation', 'decimal_symbol_count', 'min_value'];
	public $timestamps = false;
}
