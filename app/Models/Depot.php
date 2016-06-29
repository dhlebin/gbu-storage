<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    protected $fillable = ['name', 'description', 'owner_organization_id'];

    public function organizationRoles()
    {
        return $this->hasMany(DepotOrganizationRole::class);
    }

    public function items()
    {
        return $this->hasMany(DepotItem::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($model) {
            $model->organizationRoles()->delete();
            $model->items()->delete();
        });
    }
}
