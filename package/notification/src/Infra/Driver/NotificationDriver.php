<?php

namespace Epush\Notification\Infra\Driver;

use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Notification;
use Epush\Notification\Infra\Job\SendNotificationJob;

class NotificationDriver implements NotificationDriverContract
{
    public function __construct(

        private string $defaultSubject = '',
        private string $channelPrefix = ''

    ) {

        $this->defaultSubject = config('notification.default_notification_subject');
        $this->channelPrefix = config('notification.notification_broadcast_channel_prefix');
    }




    public function sendNotification(string $userID, string $content, string $subject = null): array
    {
        Notification::route('broadcast', [new Channel($this->channelPrefix.".".$userID)])
        ->notify(new SendNotificationJob($content, $subject ?? $this->defaultSubject));
        return [];
    }
}