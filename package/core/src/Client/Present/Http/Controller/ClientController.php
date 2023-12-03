<?php

namespace Epush\Core\Client\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\Client\Domain\DTO\ClientDto;
use Epush\Core\Client\Domain\DTO\AddClientDto;
use Epush\Core\Client\Domain\DTO\ListClientsDto;
use Epush\Core\Client\Domain\DTO\SearchClientDto;
use Epush\Core\Client\Domain\DTO\UpdateClientDto;

use Epush\Core\Client\Domain\UseCase\GetClientUseCase;
use Epush\Core\Client\Domain\UseCase\AddClientUseCase;
use Epush\Core\Client\Domain\UseCase\ListClientsUseCase;
use Epush\Core\Client\Domain\UseCase\DeleteClientUseCase;
use Epush\Core\Client\Domain\UseCase\SearchClientUseCase;
use Epush\Core\Client\Domain\UseCase\UpdateClientUseCase;
use Epush\Core\Client\Domain\UseCase\GetClientOrdersUseCase;
use Epush\Core\Client\Domain\UseCase\GetClientSendersUseCase;
use Epush\Core\Client\Domain\UseCase\GetClientMessagesUseCase;
use Epush\Core\Client\Domain\UseCase\GetClientLatestOrderUseCase;
use Epush\Core\Client\Domain\UseCase\GetClientMessageGroupsUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/client')]
class ClientController
{
    #[Get('/')]
    public function listClients(ListClientsDto $listClientsDto, ListClientsUseCase $listClientsUseCase): Response
    {
        return jsonResponse($listClientsUseCase->execute($listClientsDto));
    }

    #[Post('/')]
    public function addClient(AddClientDto $addClientDto, AddClientUseCase $addClientUseCase): Response
    {
        return jsonResponse($addClientUseCase->execute($addClientDto));
    }

    #[Get('{user_id}')]
    public function getClient(ClientDto $clientDto, GetClientUseCase $getClientUseCase): Response
    {
        return jsonResponse($getClientUseCase->execute($clientDto));
    }

    #[Put('{user_id}')]
    public function updateClient(ClientDto $clientDto, UpdateClientDto $updateClientDto, UpdateClientUseCase $updateClientUseCase): Response
    {
        return jsonResponse($updateClientUseCase->execute($clientDto, $updateClientDto));
    }

    #[Delete('{user_id}')]
    public function deleteClient(ClientDto $clientDto, DeleteClientUseCase $deleteClientUseCase): Response
    {
        return jsonResponse($deleteClientUseCase->execute($clientDto));
    }

    #[Get('{user_id}/orders')]
    public function getClientOrders(ClientDto $clientDto, GetClientOrdersUseCase $getClientOrdersUseCase): Response
    {
        return jsonResponse($getClientOrdersUseCase->execute($clientDto));
    }

    #[Get('{user_id}/senders')]
    public function getClientSenders(ClientDto $clientDto, GetClientSendersUseCase $getClientSendersUseCase): Response
    {
        return jsonResponse($getClientSendersUseCase->execute($clientDto));
    }

    #[Get('{user_id}/messages')]
    public function getClientMessages(ClientDto $clientDto, GetClientMessagesUseCase $getClientMessagesUseCase): Response
    {
        return jsonResponse($getClientMessagesUseCase->execute($clientDto));
    }

    #[Get('{user_id}/message-groups')]
    public function getClientMessageGroups(ClientDto $clientDto, GetClientMessageGroupsUseCase $getClientMessageGroupsUseCase): Response
    {
        return jsonResponse($getClientMessageGroupsUseCase->execute($clientDto));
    }

    #[Get('{user_id}/latest-order')]
    public function getClientLatestOrder(ClientDto $clientDto, GetClientLatestOrderUseCase $getClientLatestOrderUseCase): Response
    {
        return jsonResponse($getClientLatestOrderUseCase->execute($clientDto));
    }

    #[Post('/search')]
    public function searchClientColumn(SearchClientDto $searchClientDto, SearchClientUseCase $searchClientUseCase): Response
    {
        return jsonResponse($searchClientUseCase->execute($searchClientDto));
    }
}