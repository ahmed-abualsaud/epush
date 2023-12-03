<?php

namespace Epush\Core\MessageGroupRecipient\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\MessageGroupRecipient\Domain\DTO\MessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\Domain\DTO\AddMessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\Domain\DTO\ListMessageGroupRecipientsDto;
use Epush\Core\MessageGroupRecipient\Domain\DTO\SearchMessageGroupRecipientDto;
use Epush\Core\MessageGroupRecipient\Domain\DTO\UpdateMessageGroupRecipientDto;

use Epush\Core\MessageGroupRecipient\Domain\UseCase\GetMessageGroupRecipientUseCase;
use Epush\Core\MessageGroupRecipient\Domain\UseCase\AddMessageGroupRecipientUseCase;
use Epush\Core\MessageGroupRecipient\Domain\UseCase\ListMessageGroupRecipientsUseCase;
use Epush\Core\MessageGroupRecipient\Domain\UseCase\DeleteMessageGroupRecipientUseCase;
use Epush\Core\MessageGroupRecipient\Domain\UseCase\SearchMessageGroupRecipientUseCase;
use Epush\Core\MessageGroupRecipient\Domain\UseCase\UpdateMessageGroupRecipientUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/message-group-recipient')]
class MessageGroupRecipientController
{
    #[Get('/')]
    public function listMessageGroupRecipients(ListMessageGroupRecipientsDto $listMessageGroupRecipientsDto, ListMessageGroupRecipientsUseCase $listMessageGroupRecipientsUseCase): Response
    {
        return jsonResponse($listMessageGroupRecipientsUseCase->execute($listMessageGroupRecipientsDto));
    }

    #[Post('/')]
    public function addMessageGroupRecipient(AddMessageGroupRecipientDto $addMessageGroupRecipientDto, AddMessageGroupRecipientUseCase $addMessageGroupRecipientUseCase): Response
    {
        return jsonResponse($addMessageGroupRecipientUseCase->execute($addMessageGroupRecipientDto));
    }

    #[Get('{message_group_recipient_id}')]
    public function getMessageGroupRecipient(MessageGroupRecipientDto $messageGroupRecipientDto, GetMessageGroupRecipientUseCase $getMessageGroupRecipientUseCase): Response
    {
        return jsonResponse($getMessageGroupRecipientUseCase->execute($messageGroupRecipientDto));
    }

    #[Put('{message_group_recipient_id}')]
    public function updateMessageGroupRecipient(MessageGroupRecipientDto $messageGroupRecipientDto, UpdateMessageGroupRecipientDto $updateMessageGroupRecipientDto, UpdateMessageGroupRecipientUseCase $updateMessageGroupRecipientUseCase): Response
    {
        return jsonResponse($updateMessageGroupRecipientUseCase->execute($messageGroupRecipientDto, $updateMessageGroupRecipientDto));
    }

    #[Delete('{message_group_recipient_id}')]
    public function deleteMessageGroupRecipient(MessageGroupRecipientDto $messageGroupRecipientDto, DeleteMessageGroupRecipientUseCase $deleteMessageGroupRecipientUseCase): Response
    {
        return jsonResponse($deleteMessageGroupRecipientUseCase->execute($messageGroupRecipientDto));
    }

    #[Post('/search')]
    public function searchMessageGroupRecipientColumn(SearchMessageGroupRecipientDto $searchMessageGroupRecipientDto, SearchMessageGroupRecipientUseCase $searchMessageGroupRecipientUseCase): Response
    {
        return jsonResponse($searchMessageGroupRecipientUseCase->execute($searchMessageGroupRecipientDto));
    }
}