<?php

namespace Epush\Auth\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Epush\Shared\Infra\Database\BlindCreate;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes, BlindCreate;

    protected $guarded = [];
}