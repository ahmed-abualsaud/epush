<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Notification\Domain\DTO\NotificationTemplateDto;
use Epush\Notification\Domain\DTO\UpdateNotificationTemplateDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateNotificationTemplateUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(NotificationTemplateDto $notificationTemplateDto, UpdateNotificationTemplateDto $updateNotificationTemplateDto): array
    {
        $this->validationService->validate($notificationTemplateDto->toArray(), NotificationTemplateDto::rules());
        $this->validationService->validate($updateNotificationTemplateDto->toArray(), UpdateNotificationTemplateDto::rules());
        return $this->notificationService->updateNotificationTemplate($notificationTemplateDto->getNotificationTemplateID(), $updateNotificationTemplateDto->toArray());
    }
}