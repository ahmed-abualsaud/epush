<?php

namespace Epush\Mail\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Mail\Domain\DTO\MailSendingHandlerDto;
use Epush\Mail\Domain\DTO\AddMailSendingHandlerDto;
use Epush\Mail\Domain\DTO\ListMailSendingHandlersDto;
use Epush\Mail\Domain\DTO\SearchMailSendingHandlerDto;
use Epush\Mail\Domain\DTO\UpdateMailSendingHandlerDto;

use Epush\Mail\Domain\UseCase\AddMailSendingHandlerUseCase;
use Epush\Mail\Domain\UseCase\GetMailSendingHandlerUseCase;
use Epush\Mail\Domain\UseCase\ListMailSendingHandlersUseCase;
use Epush\Mail\Domain\UseCase\DeleteMailSendingHandlerUseCase;
use Epush\Mail\Domain\UseCase\SearchMailSendingHandlerUseCase;
use Epush\Mail\Domain\UseCase\UpdateMailSendingHandlerUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/mail')]
class MailSendingHandlerController
{
    #[Get('sending-handler')]
    public function listMailSendingHandlers(ListMailSendingHandlersDto $listMailSendingHandlersDto, ListMailSendingHandlersUseCase $listMailSendingHandlersUseCase): Response
    {
        return successJSONResponse($listMailSendingHandlersUseCase->execute($listMailSendingHandlersDto));
    }

    #[Post('sending-handler')]
    public function addMailSendingHandler(AddMailSendingHandlerDto $addMailSendingHandlerDto, AddMailSendingHandlerUseCase $addMailSendingHandlerUseCase): Response
    {
        return successJSONResponse($addMailSendingHandlerUseCase->execute($addMailSendingHandlerDto));
    }

    #[Get('sending-handler/{mail_sending_handler_id}')]
    public function getMailSendingHandler(MailSendingHandlerDto $mailSendingHandlerDto, GetMailSendingHandlerUseCase $getMailSendingHandlerUseCase): Response
    {
        return successJSONResponse($getMailSendingHandlerUseCase->execute($mailSendingHandlerDto));
    }

    #[Put('sending-handler/{mail_sending_handler_id}')]
    public function updateMailSendingHandler(MailSendingHandlerDto $mailSendingHandlerDto, UpdateMailSendingHandlerDto $updateMailSendingHandlerDto, UpdateMailSendingHandlerUseCase $updateMailSendingHandlerUseCase): Response
    {
        return successJSONResponse($updateMailSendingHandlerUseCase->execute($mailSendingHandlerDto, $updateMailSendingHandlerDto));
    }

    #[Delete('sending-handler/{mail_sending_handler_id}')]
    public function deleteMailSendingHandler(MailSendingHandlerDto $mailSendingHandlerDto, DeleteMailSendingHandlerUseCase $deleteMailSendingHandlerUseCase): Response
    {
        return successJSONResponse($deleteMailSendingHandlerUseCase->execute($mailSendingHandlerDto));
    }

    #[Post('sending-handler/search')]
    public function searchMailSendingHandlerColumn(SearchMailSendingHandlerDto $searchMailSendingHandlerDto, SearchMailSendingHandlerUseCase $searchMailSendingHandlerUseCase): Response
    {
        return successJSONResponse($searchMailSendingHandlerUseCase->execute($searchMailSendingHandlerDto));
    }
}