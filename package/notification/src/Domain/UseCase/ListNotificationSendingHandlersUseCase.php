<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Notification\Domain\DTO\ListNotificationSendingHandlersDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListNotificationSendingHandlersUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListNotificationSendingHandlersDto $listNotificationSendingHandlersDto): array
    {
        $this->validationService->validate($listNotificationSendingHandlersDto->toArray(), ListNotificationSendingHandlersDto::rules());
        return $this->notificationService->listNotificationSendingHandlers($listNotificationSendingHandlersDto->getPageSize());
    }
}