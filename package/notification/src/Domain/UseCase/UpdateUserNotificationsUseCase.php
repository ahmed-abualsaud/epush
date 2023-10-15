<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\Domain\DTO\UpdateUserNotificationsDto;
use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Notification\Domain\DTO\UserNotificationsDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateUserNotificationsUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserNotificationsDto $userNotificationDto, UpdateUserNotificationsDto $UpdateUserNotificationsDto): array
    {
        $this->validationService->validate($userNotificationDto->toArray(), UserNotificationsDto::rules());
        $this->validationService->validate($UpdateUserNotificationsDto->toArray(), UpdateUserNotificationsDto::rules());
        return $this->notificationService->updateUserNotifications($userNotificationDto->getUserID(), $UpdateUserNotificationsDto->toArray());
    }
}