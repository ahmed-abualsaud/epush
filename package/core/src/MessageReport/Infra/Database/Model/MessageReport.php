<?php

namespace Epush\Core\MessageReport\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class MessageReport extends Model
{
    protected $guarded = [];

    protected $casts = [
        'operators' => 'json'
    ];
}