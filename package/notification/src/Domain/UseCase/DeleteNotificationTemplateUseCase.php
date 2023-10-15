<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\Domain\DTO\NotificationTemplateDto;
use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteNotificationTemplateUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(NotificationTemplateDto $notificationTemplateDto): bool
    {
        $this->validationService->validate($notificationTemplateDto->toArray(), NotificationTemplateDto::rules());
        return $this->notificationService->deleteNotificationTemplate($notificationTemplateDto->getNotificationTemplateID());
    }
}