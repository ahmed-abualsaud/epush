<?php

namespace Epush\Core\SenderConnection\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\SenderConnection\Domain\DTO\SenderConnectionDto;
use Epush\Core\SenderConnection\Domain\DTO\AddSenderConnectionDto;
use Epush\Core\SenderConnection\Domain\DTO\GetSenderConnectionsDto;
use Epush\Core\SenderConnection\Domain\DTO\ListSenderConnectionsDto;
use Epush\Core\SenderConnection\Domain\DTO\SearchSenderConnectionDto;
use Epush\Core\SenderConnection\Domain\DTO\UpdateSenderConnectionDto;

use Epush\Core\SenderConnection\Domain\UseCase\GetSenderConnectionUseCase;
use Epush\Core\SenderConnection\Domain\UseCase\AddSenderConnectionUseCase;
use Epush\Core\SenderConnection\Domain\UseCase\ListSenderConnectionsUseCase;
use Epush\Core\SenderConnection\Domain\UseCase\DeleteSenderConnectionUseCase;
use Epush\Core\SenderConnection\Domain\UseCase\GetSenderConnectionsUseCase;
use Epush\Core\SenderConnection\Domain\UseCase\SearchSenderConnectionUseCase;
use Epush\Core\SenderConnection\Domain\UseCase\UpdateSenderConnectionUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api')]
class SenderConnectionController
{
    #[Get('sender-connection')]
    public function listSendersConnections(ListSenderConnectionsDto $listSenderConnectionsDto, ListSenderConnectionsUseCase $listSenderConnectionsUseCase): Response
    {
        return successJSONResponse($listSenderConnectionsUseCase->execute($listSenderConnectionsDto));
    }

    #[Post('sender-connection')]
    public function addSenderConnection(AddSenderConnectionDto $addSenderConnectionDto, AddSenderConnectionUseCase $addSenderConnectionUseCase): Response
    {
        return successJSONResponse($addSenderConnectionUseCase->execute($addSenderConnectionDto));
    }

    #[Get('sender/{sender_id}/connections')]
    public function getSenderConnections(GetSenderConnectionsDto $getSenderConnectionsDto, GetSenderConnectionsUseCase $getSenderConnectionsUseCase): Response
    {
        return successJSONResponse($getSenderConnectionsUseCase->execute($getSenderConnectionsDto));
    }

    #[Get('sender-connection/{sender_connection_id}')]
    public function getSenderConnection(SenderConnectionDto $senderconnectionDto, GetSenderConnectionUseCase $getSenderConnectionUseCase): Response
    {
        return successJSONResponse($getSenderConnectionUseCase->execute($senderconnectionDto));
    }

    #[Put('sender-connection/{sender_connection_id}')]
    public function updateSenderConnection(SenderConnectionDto $senderconnectionDto, UpdateSenderConnectionDto $updateSenderConnectionDto, UpdateSenderConnectionUseCase $updateSenderConnectionUseCase): Response
    {
        return successJSONResponse($updateSenderConnectionUseCase->execute($senderconnectionDto, $updateSenderConnectionDto));
    }

    #[Delete('sender-connection/{sender_connection_id}')]
    public function deleteSenderConnection(SenderConnectionDto $senderconnectionDto, DeleteSenderConnectionUseCase $deleteSenderConnectionUseCase): Response
    {
        return successJSONResponse($deleteSenderConnectionUseCase->execute($senderconnectionDto));
    }

    #[Post('sender-connection/search')]
    public function searchSenderConnectionColumn(SearchSenderConnectionDto $searchSenderConnectionDto, SearchSenderConnectionUseCase $searchSenderConnectionUseCase): Response
    {
        return successJSONResponse($searchSenderConnectionUseCase->execute($searchSenderConnectionDto));
    }
}