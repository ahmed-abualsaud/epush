<?php

namespace Epush\Orchi\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class Handler extends Model
{
    protected $guarded = [];

    protected $casts = [
        'enabled' => 'boolean'
    ];
}