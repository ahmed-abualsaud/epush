<?php

namespace Epush\Notification\Infra\Database\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationSendingHandler extends Model
{
    protected $table = "notification_sending_handlers";

    protected $guarded = [];


    public function notificationTemplate(): BelongsTo
    {
        return $this->belongsTo(NotificationTemplate::class, 'notification_template_id');
    }
}