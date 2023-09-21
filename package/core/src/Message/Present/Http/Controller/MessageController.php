<?php

namespace Epush\Core\Message\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\Message\Domain\DTO\MessageDto;
use Epush\Core\Message\Domain\DTO\AddMessageDto;
use Epush\Core\Message\Domain\DTO\ListMessagesDto;
use Epush\Core\Message\Domain\DTO\SearchMessageDto;
use Epush\Core\Message\Domain\DTO\UpdateMessageDto;
use Epush\Core\Message\Domain\DTO\BulkAddMessageDto;

use Epush\Core\Message\Domain\UseCase\GetMessageUseCase;
use Epush\Core\Message\Domain\UseCase\AddMessageUseCase;
use Epush\Core\Message\Domain\UseCase\ListMessagesUseCase;
use Epush\Core\Message\Domain\UseCase\DeleteMessageUseCase;
use Epush\Core\Message\Domain\UseCase\SearchMessageUseCase;
use Epush\Core\Message\Domain\UseCase\UpdateMessageUseCase;
use Epush\Core\Message\Domain\UseCase\BulkAddMessageUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/message')]
class MessageController
{
    #[Get('/')]
    public function listMessages(ListMessagesDto $listMessagesDto, ListMessagesUseCase $listMessagesUseCase): Response
    {
        return successJSONResponse($listMessagesUseCase->execute($listMessagesDto));
    }

    #[Post('/')]
    public function addMessage(AddMessageDto $addMessageDto, AddMessageUseCase $addMessageUseCase): Response
    {
        return successJSONResponse($addMessageUseCase->execute($addMessageDto));
    }

    #[Post('/bulk-add')]
    public function bulkAddMessage(BulkAddMessageDto $bulkAddMessageDto, BulkAddMessageUseCase $bulkAddMessageUseCase): Response
    {
        return successJSONResponse($bulkAddMessageUseCase->execute($bulkAddMessageDto));
    }

    #[Get('{message_id}')]
    public function getMessage(MessageDto $messageDto, GetMessageUseCase $getMessageUseCase): Response
    {
        return successJSONResponse($getMessageUseCase->execute($messageDto));
    }

    #[Put('{message_id}')]
    public function updateMessage(MessageDto $messageDto, UpdateMessageDto $updateMessageDto, UpdateMessageUseCase $updateMessageUseCase): Response
    {
        return successJSONResponse($updateMessageUseCase->execute($messageDto, $updateMessageDto));
    }

    #[Delete('{message_id}')]
    public function deleteMessage(MessageDto $messageDto, DeleteMessageUseCase $deleteMessageUseCase): Response
    {
        return successJSONResponse($deleteMessageUseCase->execute($messageDto));
    }

    #[Post('/search')]
    public function searchMessageColumn(SearchMessageDto $searchMessageDto, SearchMessageUseCase $searchMessageUseCase): Response
    {
        return successJSONResponse($searchMessageUseCase->execute($searchMessageDto));
    }
}