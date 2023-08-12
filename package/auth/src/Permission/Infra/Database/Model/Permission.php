<?php

namespace Epush\Auth\Permission\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Epush\Shared\Infra\Database\BlindCreate;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes, BlindCreate;

    protected $guarded = [];
}