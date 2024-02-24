<?php

namespace Epush\Core\IPWhitelist\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class IPWhitelist extends Model
{
    protected $table = "ip_whitelists";

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'allowed' => 'boolean',
    ];
}