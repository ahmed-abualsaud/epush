<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\Domain\DTO\NotificationSendingHandlerDto;
use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteNotificationSendingHandlerUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(NotificationSendingHandlerDto $notificationSendingHandlerDto): bool
    {
        $this->validationService->validate($notificationSendingHandlerDto->toArray(), NotificationSendingHandlerDto::rules());
        return $this->notificationService->deleteNotificationSendingHandler($notificationSendingHandlerDto->getNotificationSendingHandlerID());
    }
}