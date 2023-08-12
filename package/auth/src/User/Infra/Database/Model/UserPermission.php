<?php

namespace Epush\Auth\User\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table = 'users_permissions';
    protected $guarded = [];
}