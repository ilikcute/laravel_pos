<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    protected $guarded = ['id'];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
