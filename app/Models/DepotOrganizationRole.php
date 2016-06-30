<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepotOrganizationRole extends Model
{
    protected $fillable = ['depot_id', 'organization_id', 'user_role_id', 'role'];

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }
}
