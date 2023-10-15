<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\Domain\DTO\UserNotificationsDto;
use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetUserUnreadNotificationsUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(UserNotificationsDto $userNotificationsDto): array
    {
        $this->validationService->validate($userNotificationsDto->toArray(), UserNotificationsDto::rules());
        return $this->notificationService->getUserUnreadNotifications($userNotificationsDto->getUserID());
    }
}