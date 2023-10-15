<?php

namespace Epush\Notification\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Notification\Infra\Database\Model\UserNotification;
use Epush\Notification\Infra\Database\Repository\Contract\UserNotificationRepositoryContract;

class UserNotificationRepository implements UserNotificationRepositoryContract
{
    public function __construct(

        private UserNotification $userNotification
        
    ) {}

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->userNotification->all()->toArray();

        });
    }

    public function get(string $notificationID): array
    {
        return DB::transaction(function () use ($notificationID) {

            $notification = $this->userNotification->where('id', $notificationID)->first();
            return empty($notification) ? [] : $notification->toArray();

        });
    }

    public function getUserNotifications(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            return $this->userNotification->where('user_id', $userID)->get()->toArray();

        });
    }

    public function getUserUnreadNotifications(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            return $this->userNotification->where('user_id', $userID)->where('read', false)->get()->toArray();

        });
    }
    
    public function create(array $notification): array
    {
        return DB::transaction(function () use ($notification) {

            return $this->userNotification->create($notification)->toArray();

        });
    }

    public function update(string $notificationID, array $data): array
    {
        return DB::transaction(function () use ($notificationID, $data) {

            $notification = $this->userNotification->where('id', $notificationID)->firstOrFail();

            if (! empty($data)) {
                $notification->update($data);
            }

            return $notification->toArray();

        });
    }

    public function updateUserNotifications(string $userID, array $data): array
    {
        return DB::transaction(function () use ($userID, $data) {

            if (! empty($data)) {
                $this->userNotification->where('user_id', $userID)->update($data);
            }

            return $this->userNotification->where('user_id', $userID)->get()->toArray();

        });
    }

    public function delete(string $notificationID): bool
    {
        return DB::transaction(function () use ($notificationID) {

            return $this->userNotification->where('id', $notificationID)->delete();

        }); 
    }
}