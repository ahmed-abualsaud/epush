<?php

namespace Epush\Notification\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Notification\Domain\DTO\UserNotificationDto;
use Epush\Notification\Domain\DTO\AddUserNotificationDto;
use Epush\Notification\Domain\DTO\UpdateUserNotificationDto;
use Epush\Notification\Domain\DTO\UpdateUserNotificationsDto;
use Epush\Notification\Domain\DTO\UserNotificationsDto;
use Epush\Notification\Domain\UseCase\AddUserNotificationUseCase;
use Epush\Notification\Domain\UseCase\GetUserNotificationUseCase;
use Epush\Notification\Domain\UseCase\ListUserNotificationsUseCase;
use Epush\Notification\Domain\UseCase\DeleteUserNotificationUseCase;
use Epush\Notification\Domain\UseCase\GetUserNotificationsUseCase;
use Epush\Notification\Domain\UseCase\GetUserUnreadNotificationsUseCase;
use Epush\Notification\Domain\UseCase\UpdateUserNotificationsUseCase;
use Epush\Notification\Domain\UseCase\UpdateUserNotificationUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/notification')]
class UserNotificationController
{
    // #[Get('/')]
    // public function listUserNotifications(ListUserNotificationsUseCase $listUserNotificationsUseCase): Response
    // {
    //     return jsonResponse($listUserNotificationsUseCase->execute());
    // }

    #[Get('/user-notifications/{user_id}')]
    public function getUserNotifications(UserNotificationsDto $userNotificationsDto, GetUserNotificationsUseCase $getUserNotificationsUseCase): Response
    {
        return jsonResponse($getUserNotificationsUseCase->execute($userNotificationsDto));
    }

    #[Get('/user-unread-notifications/{user_id}')]
    public function getUserUnreadNotifications(UserNotificationsDto $userNotificationsDto, GetUserUnreadNotificationsUseCase $getUserUnreadNotificationsUseCase): Response
    {
        return jsonResponse($getUserUnreadNotificationsUseCase->execute($userNotificationsDto));
    }

    #[Post('/')]
    public function addUserNotification(AddUserNotificationDto $addUserNotificationDto, AddUserNotificationUseCase $addUserNotificationUseCase): Response
    {
        return jsonResponse($addUserNotificationUseCase->execute($addUserNotificationDto));
    }

    // #[Get('{user_notification_id}')]
    // public function getUserNotification(UserNotificationDto $UserNotificationDto, GetUserNotificationUseCase $getUserNotificationUseCase): Response
    // {
    //     return jsonResponse($getUserNotificationUseCase->execute($UserNotificationDto));
    // }

    #[Put('{user_notification_id}')]
    public function updateUserNotification(UserNotificationDto $UserNotificationDto, UpdateUserNotificationDto $updateUserNotificationDto, UpdateUserNotificationUseCase $updateUserNotificationUseCase): Response
    {
        return jsonResponse($updateUserNotificationUseCase->execute($UserNotificationDto, $updateUserNotificationDto));
    }

    #[Put('/user-notifications/{user_id}')]
    public function updateUserNotifications(UserNotificationsDto $UserNotificationsDto, UpdateUserNotificationsDto $updateUserNotificationsDto, UpdateUserNotificationsUseCase $updateUserNotificationsUseCase): Response
    {
        return jsonResponse($updateUserNotificationsUseCase->execute($UserNotificationsDto, $updateUserNotificationsDto));
    }

    // #[Delete('{user_notification_id}')]
    // public function deleteUserNotification(UserNotificationDto $UserNotificationDto, DeleteUserNotificationUseCase $deleteUserNotificationUseCase): Response
    // {
    //     return jsonResponse($deleteUserNotificationUseCase->execute($UserNotificationDto));
    // }
}