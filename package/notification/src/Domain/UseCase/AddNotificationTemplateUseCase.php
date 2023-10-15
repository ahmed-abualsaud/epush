<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\Domain\DTO\AddNotificationTemplateDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Notification\App\Contract\NotificationServiceContract;

class AddNotificationTemplateUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddNotificationTemplateDto $addNotificationTemplateDto): array
    {
        $this->validationService->validate($addNotificationTemplateDto->toArray(), AddNotificationTemplateDto::rules());
        return $this->notificationService->addNotificationTemplate($addNotificationTemplateDto->toArray());
    }
}