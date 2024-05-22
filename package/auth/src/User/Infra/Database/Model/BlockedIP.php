<?php

namespace Epush\Auth\User\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class BlockedIP extends Model
{
    protected $connection = 'mysql_secondary';
    protected $table = 'blocked_ips';
    protected $guarded = [];
}
