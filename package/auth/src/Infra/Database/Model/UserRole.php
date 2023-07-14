<?php

namespace Epush\Auth\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'users_roles';
    protected $guarded = [];
}