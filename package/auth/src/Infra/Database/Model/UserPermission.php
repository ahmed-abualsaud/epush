<?php

namespace Epush\Auth\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table = 'users_permissions';
    protected $guarded = [];
}