<?php

namespace Epush\Core\MessageRecipient\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Core\MessageRecipient\Domain\DTO\ListMessageRecipientsDto;
use Epush\Core\MessageRecipient\Domain\DTO\SearchMessageRecipientDto;

use Epush\Core\MessageRecipient\Domain\UseCase\ListMessageRecipientsUseCase;
use Epush\Core\MessageRecipient\Domain\UseCase\SearchMessageRecipientUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/message-recipient')]
class MessageRecipientController
{
    #[Get('/')]
    public function listMessageRecipients(ListMessageRecipientsDto $listMessageRecipientsDto, ListMessageRecipientsUseCase $listMessageRecipientsUseCase): Response
    {
        return jsonResponse($listMessageRecipientsUseCase->execute($listMessageRecipientsDto));
    }

    #[Post('/search')]
    public function searchMessageRecipientColumn(SearchMessageRecipientDto $searchMessageRecipientDto, SearchMessageRecipientUseCase $searchMessageRecipientUseCase): Response
    {
        return jsonResponse($searchMessageRecipientUseCase->execute($searchMessageRecipientDto));
    }
}