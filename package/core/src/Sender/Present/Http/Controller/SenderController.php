<?php

namespace Epush\Core\Sender\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\Sender\Domain\DTO\SenderDto;
use Epush\Core\Sender\Domain\DTO\AddSenderDto;
use Epush\Core\Sender\Domain\DTO\GetClientSendersDto;
use Epush\Core\Sender\Domain\DTO\ListSendersDto;
use Epush\Core\Sender\Domain\DTO\SearchSenderDto;
use Epush\Core\Sender\Domain\DTO\UpdateSenderDto;

use Epush\Core\Sender\Domain\UseCase\GetSenderUseCase;
use Epush\Core\Sender\Domain\UseCase\AddSenderUseCase;
use Epush\Core\Sender\Domain\UseCase\ListSendersUseCase;
use Epush\Core\Sender\Domain\UseCase\DeleteSenderUseCase;
use Epush\Core\Sender\Domain\UseCase\GetClientSendersUseCase;
use Epush\Core\Sender\Domain\UseCase\SearchSenderUseCase;
use Epush\Core\Sender\Domain\UseCase\UpdateSenderUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api')]
class SenderController
{
    #[Get('sender')]
    public function listSenders(ListSendersDto $listSendersDto, ListSendersUseCase $listSendersUseCase): Response
    {
        return successJSONResponse($listSendersUseCase->execute($listSendersDto));
    }

    #[Post('sender')]
    public function addSender(AddSenderDto $addSenderDto, AddSenderUseCase $addSenderUseCase): Response
    {
        return successJSONResponse($addSenderUseCase->execute($addSenderDto));
    }

    #[Get('sender/{sender_id}')]
    public function getSender(SenderDto $senderDto, GetSenderUseCase $getSenderUseCase): Response
    {
        return successJSONResponse($getSenderUseCase->execute($senderDto));
    }

    #[Get('client/{user_id}/senders')]
    public function getClientSenders(GetClientSendersDto $getClientSendersDto, GetClientSendersUseCase $getClientSendersUseCase): Response
    {
        return successJSONResponse($getClientSendersUseCase->execute($getClientSendersDto));
    }

    #[Put('sender/{sender_id}')]
    public function updateSender(SenderDto $senderDto, UpdateSenderDto $updateSenderDto, UpdateSenderUseCase $updateSenderUseCase): Response
    {
        return successJSONResponse($updateSenderUseCase->execute($senderDto, $updateSenderDto));
    }

    #[Delete('sender/{sender_id}')]
    public function deleteSender(SenderDto $senderDto, DeleteSenderUseCase $deleteSenderUseCase): Response
    {
        return successJSONResponse($deleteSenderUseCase->execute($senderDto));
    }

    #[Post('sender/search')]
    public function searchSenderColumn(SearchSenderDto $searchSenderDto, SearchSenderUseCase $searchSenderUseCase): Response
    {
        return successJSONResponse($searchSenderUseCase->execute($searchSenderDto));
    }
}