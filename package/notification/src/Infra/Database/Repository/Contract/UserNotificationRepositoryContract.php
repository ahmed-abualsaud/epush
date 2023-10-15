<?php

namespace Epush\Notification\Infra\Database\Repository\Contract;

interface UserNotificationRepositoryContract
{
    public function all(): array;

    public function get(string $notificationID): array;

    public function getUserNotifications(string $userID): array;

    public function getUserUnreadNotifications(string $userID): array;

    public function create(array $notification): array;

    public function update(string $notificationID, array $notification): array;

    public function updateUserNotifications(string $userID, array $notification): array;

    public function delete(string $notificationID): bool;
}