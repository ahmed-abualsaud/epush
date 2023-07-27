<?php

namespace Epush\Auth\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'roles_permissions';
    protected $guarded = [];
}