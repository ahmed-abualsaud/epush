<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\Domain\DTO\AddUserNotificationDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Notification\App\Contract\NotificationServiceContract;

class AddUserNotificationUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddUserNotificationDto $addUserNotificationDto): array
    {
        $this->validationService->validate($addUserNotificationDto->toArray(), AddUserNotificationDto::rules());
        return $this->notificationService->addUserNotification($addUserNotificationDto->toArray());
    }
}