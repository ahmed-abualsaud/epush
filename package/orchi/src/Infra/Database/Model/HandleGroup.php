<?php

namespace Epush\Orchi\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class HandleGroup extends Model
{
    protected $guarded = [];

    protected $casts = [
        'enabled' => 'boolean'
    ];
}