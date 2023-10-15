<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Notification\Domain\DTO\NotificationSendingHandlerDto;
use Epush\Notification\Domain\DTO\UpdateNotificationSendingHandlerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateNotificationSendingHandlerUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(NotificationSendingHandlerDto $notificationSendingHandlerDto, UpdateNotificationSendingHandlerDto $updateNotificationSendingHandlerDto): array
    {
        $this->validationService->validate($notificationSendingHandlerDto->toArray(), NotificationSendingHandlerDto::rules());
        $this->validationService->validate($updateNotificationSendingHandlerDto->toArray(), UpdateNotificationSendingHandlerDto::rules());
        return $this->notificationService->updateNotificationSendingHandler($notificationSendingHandlerDto->getNotificationSendingHandlerID(), $updateNotificationSendingHandlerDto->toArray());
    }
}