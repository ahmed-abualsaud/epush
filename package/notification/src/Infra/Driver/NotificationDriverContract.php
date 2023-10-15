<?php

namespace Epush\Notification\Infra\Driver;

interface NotificationDriverContract
{
    public function sendNotification(string $userID, string $content, string $subject): array;
}