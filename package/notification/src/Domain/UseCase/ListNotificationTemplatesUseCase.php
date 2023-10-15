<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\App\Contract\NotificationServiceContract;

class ListNotificationTemplatesUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService

    ) {}

    public function execute(): array
    {
        return $this->notificationService->listNotificationTemplates();
    }
}