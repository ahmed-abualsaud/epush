<?php

namespace Epush\Notification\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Notification\Domain\DTO\NotificationSendingHandlerDto;
use Epush\Notification\Domain\DTO\AddNotificationSendingHandlerDto;
use Epush\Notification\Domain\DTO\ListNotificationSendingHandlersDto;
use Epush\Notification\Domain\DTO\SearchNotificationSendingHandlerDto;
use Epush\Notification\Domain\DTO\UpdateNotificationSendingHandlerDto;

use Epush\Notification\Domain\UseCase\AddNotificationSendingHandlerUseCase;
use Epush\Notification\Domain\UseCase\GetNotificationSendingHandlerUseCase;
use Epush\Notification\Domain\UseCase\ListNotificationSendingHandlersUseCase;
use Epush\Notification\Domain\UseCase\DeleteNotificationSendingHandlerUseCase;
use Epush\Notification\Domain\UseCase\SearchNotificationSendingHandlerUseCase;
use Epush\Notification\Domain\UseCase\UpdateNotificationSendingHandlerUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/notification')]
class NotificationSendingHandlerController
{
    #[Get('sending-handler')]
    public function listNotificationSendingHandlers(ListNotificationSendingHandlersDto $listNotificationSendingHandlersDto, ListNotificationSendingHandlersUseCase $listNotificationSendingHandlersUseCase): Response
    {
        return jsonResponse($listNotificationSendingHandlersUseCase->execute($listNotificationSendingHandlersDto));
    }

    #[Post('sending-handler')]
    public function addNotificationSendingHandler(AddNotificationSendingHandlerDto $addNotificationSendingHandlerDto, AddNotificationSendingHandlerUseCase $addNotificationSendingHandlerUseCase): Response
    {
        return jsonResponse($addNotificationSendingHandlerUseCase->execute($addNotificationSendingHandlerDto));
    }

    #[Get('sending-handler/{notification_sending_handler_id}')]
    public function getNotificationSendingHandler(NotificationSendingHandlerDto $notificationSendingHandlerDto, GetNotificationSendingHandlerUseCase $getNotificationSendingHandlerUseCase): Response
    {
        return jsonResponse($getNotificationSendingHandlerUseCase->execute($notificationSendingHandlerDto));
    }

    #[Put('sending-handler/{notification_sending_handler_id}')]
    public function updateNotificationSendingHandler(NotificationSendingHandlerDto $notificationSendingHandlerDto, UpdateNotificationSendingHandlerDto $updateNotificationSendingHandlerDto, UpdateNotificationSendingHandlerUseCase $updateNotificationSendingHandlerUseCase): Response
    {
        return jsonResponse($updateNotificationSendingHandlerUseCase->execute($notificationSendingHandlerDto, $updateNotificationSendingHandlerDto));
    }

    #[Delete('sending-handler/{notification_sending_handler_id}')]
    public function deleteNotificationSendingHandler(NotificationSendingHandlerDto $notificationSendingHandlerDto, DeleteNotificationSendingHandlerUseCase $deleteNotificationSendingHandlerUseCase): Response
    {
        return jsonResponse($deleteNotificationSendingHandlerUseCase->execute($notificationSendingHandlerDto));
    }

    #[Post('sending-handler/search')]
    public function searchNotificationSendingHandlerColumn(SearchNotificationSendingHandlerDto $searchNotificationSendingHandlerDto, SearchNotificationSendingHandlerUseCase $searchNotificationSendingHandlerUseCase): Response
    {
        return jsonResponse($searchNotificationSendingHandlerUseCase->execute($searchNotificationSendingHandlerDto));
    }
}