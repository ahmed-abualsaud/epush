<?php

namespace Epush\Notification\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    protected $table = "notification_templates";

    protected $guarded = [];
}