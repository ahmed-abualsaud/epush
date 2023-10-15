<?php

namespace Epush\Notification\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Notification\Domain\DTO\NotificationTemplateDto;
use Epush\Notification\Domain\DTO\AddNotificationTemplateDto;
use Epush\Notification\Domain\DTO\UpdateNotificationTemplateDto;

use Epush\Notification\Domain\UseCase\AddNotificationTemplateUseCase;
use Epush\Notification\Domain\UseCase\GetNotificationTemplateUseCase;
use Epush\Notification\Domain\UseCase\ListNotificationTemplatesUseCase;
use Epush\Notification\Domain\UseCase\DeleteNotificationTemplateUseCase;
use Epush\Notification\Domain\UseCase\UpdateNotificationTemplateUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/notification')]
class NotificationTemplateController
{
    #[Get('template')]
    public function listNotificationTemplates(ListNotificationTemplatesUseCase $listNotificationTemplatesUseCase): Response
    {
        return successJSONResponse($listNotificationTemplatesUseCase->execute());
    }

    #[Post('template')]
    public function addNotificationTemplate(AddNotificationTemplateDto $addNotificationTemplateDto, AddNotificationTemplateUseCase $addNotificationTemplateUseCase): Response
    {
        return successJSONResponse($addNotificationTemplateUseCase->execute($addNotificationTemplateDto));
    }

    #[Get('template/{notification_template_id}')]
    public function getNotificationTemplate(NotificationTemplateDto $notificationTemplateDto, GetNotificationTemplateUseCase $getNotificationTemplateUseCase): Response
    {
        return successJSONResponse($getNotificationTemplateUseCase->execute($notificationTemplateDto));
    }

    #[Put('template/{notification_template_id}')]
    public function updateNotificationTemplate(NotificationTemplateDto $notificationTemplateDto, UpdateNotificationTemplateDto $updateNotificationTemplateDto, UpdateNotificationTemplateUseCase $updateNotificationTemplateUseCase): Response
    {
        return successJSONResponse($updateNotificationTemplateUseCase->execute($notificationTemplateDto, $updateNotificationTemplateDto));
    }

    #[Delete('template/{notification_template_id}')]
    public function deleteNotificationTemplate(NotificationTemplateDto $notificationTemplateDto, DeleteNotificationTemplateUseCase $deleteNotificationTemplateUseCase): Response
    {
        return successJSONResponse($deleteNotificationTemplateUseCase->execute($notificationTemplateDto));
    }
}