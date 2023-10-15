<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\Domain\DTO\UserNotificationDto;
use Epush\Notification\Domain\DTO\UpdateUserNotificationDto;
use Epush\Notification\App\Contract\NotificationServiceContract;

use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateUserNotificationUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserNotificationDto $userNotificationDto, UpdateUserNotificationDto $updateUserNotificationDto): array
    {
        $this->validationService->validate($userNotificationDto->toArray(), UserNotificationDto::rules());
        $this->validationService->validate($updateUserNotificationDto->toArray(), UpdateUserNotificationDto::rules());
        return $this->notificationService->updateUserNotification($userNotificationDto->getUserNotificationID(), $updateUserNotificationDto->toArray());
    }
}