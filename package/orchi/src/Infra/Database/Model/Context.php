<?php

namespace Epush\Orchi\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    protected $guarded = [];

    protected $casts = [
        'enabled' => 'boolean',
        'online' => 'boolean'
    ];
}