<?php

namespace Epush\Expense\Order\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deduct' => 'boolean',
    ];

    protected $guarded = [];
}