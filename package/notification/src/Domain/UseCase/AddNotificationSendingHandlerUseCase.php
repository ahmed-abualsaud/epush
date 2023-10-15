<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\Domain\DTO\AddNotificationSendingHandlerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Notification\App\Contract\NotificationServiceContract;

class AddNotificationSendingHandlerUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddNotificationSendingHandlerDto $addNotificationSendingHandlerDto): array
    {
        $this->validationService->validate($addNotificationSendingHandlerDto->toArray(), AddNotificationSendingHandlerDto::rules());
        return $this->notificationService->addNotificationSendingHandler($addNotificationSendingHandlerDto->toArray());
    }
}