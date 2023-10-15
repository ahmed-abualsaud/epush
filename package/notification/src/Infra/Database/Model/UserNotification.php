<?php

namespace Epush\Notification\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = "user_notifications";

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'read' => 'boolean',
    ];
}