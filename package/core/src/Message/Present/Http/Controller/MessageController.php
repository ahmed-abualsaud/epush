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
use Epush\Core\Message\Domain\DTO\GetMessageRecipientsDto;

use Epush\Core\Message\Domain\UseCase\GetMessageUseCase;
use Epush\Core\Message\Domain\UseCase\AddMessageUseCase;
use Epush\Core\Message\Domain\UseCase\ListMessagesUseCase;
use Epush\Core\Message\Domain\UseCase\DeleteMessageUseCase;
use Epush\Core\Message\Domain\UseCase\SearchMessageUseCase;
use Epush\Core\Message\Domain\UseCase\UpdateMessageUseCase;
use Epush\Core\Message\Domain\UseCase\BulkAddMessageUseCase;
use Epush\Core\Message\Domain\UseCase\GetMessageRecipientsUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/message')]
class MessageController
{
    #[Get('/')]
    public function listMessages(ListMessagesDto $listMessagesDto, ListMessagesUseCase $listMessagesUseCase): Response
    {
        return jsonResponse($listMessagesUseCase->execute($listMessagesDto));
    }

    #[Post('/')]
    public function addMessage(AddMessageDto $addMessageDto, AddMessageUseCase $addMessageUseCase): Response
    {
        return jsonResponse($addMessageUseCase->execute($addMessageDto));
    }

    #[Post('/bulk-add')]
    public function bulkAddMessage(BulkAddMessageDto $bulkAddMessageDto, BulkAddMessageUseCase $bulkAddMessageUseCase): Response
    {
        return jsonResponse($bulkAddMessageUseCase->execute($bulkAddMessageDto));
    }

    #[Get('{message_id}')]
    public function getMessage(MessageDto $messageDto, GetMessageUseCase $getMessageUseCase): Response
    {
        return jsonResponse($getMessageUseCase->execute($messageDto));
    }

    #[Put('{message_id}')]
    public function updateMessage(MessageDto $messageDto, UpdateMessageDto $updateMessageDto, UpdateMessageUseCase $updateMessageUseCase): Response
    {
        return jsonResponse($updateMessageUseCase->execute($messageDto, $updateMessageDto));
    }

    #[Delete('{message_id}')]
    public function deleteMessage(MessageDto $messageDto, DeleteMessageUseCase $deleteMessageUseCase): Response
    {
        return jsonResponse($deleteMessageUseCase->execute($messageDto));
    }

    #[Post('/search')]
    public function searchMessageColumn(SearchMessageDto $searchMessageDto, SearchMessageUseCase $searchMessageUseCase): Response
    {
        return jsonResponse($searchMessageUseCase->execute($searchMessageDto));
    }

    #[Get('{message_id}/recipients')]
    public function getMessageRecipients(GetMessageRecipientsDto $getMessageRecipientsDto, GetMessageRecipientsUseCase $getMessageRecipientsUseCase): Response
    {
        return jsonResponse($getMessageRecipientsUseCase->execute($getMessageRecipientsDto));
    }
}