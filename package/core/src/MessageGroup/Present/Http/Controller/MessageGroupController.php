<?php

namespace Epush\Core\MessageGroup\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\MessageGroup\Domain\DTO\MessageGroupDto;
use Epush\Core\MessageGroup\Domain\DTO\AddMessageGroupDto;
use Epush\Core\MessageGroup\Domain\DTO\ListMessageGroupsDto;
use Epush\Core\MessageGroup\Domain\DTO\SearchMessageGroupDto;
use Epush\Core\MessageGroup\Domain\DTO\UpdateMessageGroupDto;

use Epush\Core\MessageGroup\Domain\UseCase\GetMessageGroupUseCase;
use Epush\Core\MessageGroup\Domain\UseCase\AddMessageGroupUseCase;
use Epush\Core\MessageGroup\Domain\UseCase\ListMessageGroupsUseCase;
use Epush\Core\MessageGroup\Domain\UseCase\DeleteMessageGroupUseCase;
use Epush\Core\MessageGroup\Domain\UseCase\SearchMessageGroupUseCase;
use Epush\Core\MessageGroup\Domain\UseCase\UpdateMessageGroupUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/message-group')]
class MessageGroupController
{
    #[Get('/')]
    public function listMessageGroups(ListMessageGroupsDto $listMessageGroupsDto, ListMessageGroupsUseCase $listMessageGroupsUseCase): Response
    {
        return successJSONResponse($listMessageGroupsUseCase->execute($listMessageGroupsDto));
    }

    #[Post('/')]
    public function addMessageGroup(AddMessageGroupDto $addMessageGroupDto, AddMessageGroupUseCase $addMessageGroupUseCase): Response
    {
        return successJSONResponse($addMessageGroupUseCase->execute($addMessageGroupDto));
    }

    #[Get('{message_group_id}')]
    public function getMessageGroup(MessageGroupDto $messageGroupDto, GetMessageGroupUseCase $getMessageGroupUseCase): Response
    {
        return successJSONResponse($getMessageGroupUseCase->execute($messageGroupDto));
    }

    #[Put('{message_group_id}')]
    public function updateMessageGroup(MessageGroupDto $messageGroupDto, UpdateMessageGroupDto $updateMessageGroupDto, UpdateMessageGroupUseCase $updateMessageGroupUseCase): Response
    {
        return successJSONResponse($updateMessageGroupUseCase->execute($messageGroupDto, $updateMessageGroupDto));
    }

    #[Delete('{message_group_id}')]
    public function deleteMessageGroup(MessageGroupDto $messageGroupDto, DeleteMessageGroupUseCase $deleteMessageGroupUseCase): Response
    {
        return successJSONResponse($deleteMessageGroupUseCase->execute($messageGroupDto));
    }

    #[Post('/search')]
    public function searchMessageGroupColumn(SearchMessageGroupDto $searchMessageGroupDto, SearchMessageGroupUseCase $searchMessageGroupUseCase): Response
    {
        return successJSONResponse($searchMessageGroupUseCase->execute($searchMessageGroupDto));
    }
}