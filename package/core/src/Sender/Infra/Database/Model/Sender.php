<?php

namespace Epush\Core\Sender\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;


class Sender extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'approved' => 'boolean',
    ];
}