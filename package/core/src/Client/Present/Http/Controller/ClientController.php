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

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/client')]
class ClientController
{
    #[Get('/')]
    public function listClients(ListClientsDto $listClientsDto, ListClientsUseCase $listClientsUseCase): Response
    {
        return successJSONResponse($listClientsUseCase->execute($listClientsDto));
    }

    #[Post('/')]
    public function addClient(AddClientDto $addClientDto, AddClientUseCase $addClientUseCase): Response
    {
        return successJSONResponse($addClientUseCase->execute($addClientDto));
    }

    #[Get('{user_id}')]
    public function getClient(ClientDto $clientDto, GetClientUseCase $getClientUseCase): Response
    {
        return successJSONResponse($getClientUseCase->execute($clientDto));
    }

    #[Put('{user_id}')]
    public function updateClient(ClientDto $clientDto, UpdateClientDto $updateClientDto, UpdateClientUseCase $updateClientUseCase): Response
    {
        return successJSONResponse($updateClientUseCase->execute($clientDto, $updateClientDto));
    }

    #[Delete('{user_id}')]
    public function deleteClient(ClientDto $clientDto, DeleteClientUseCase $deleteClientUseCase): Response
    {
        return successJSONResponse($deleteClientUseCase->execute($clientDto));
    }

    #[Get('{user_id}/orders')]
    public function getClientOrders(ClientDto $clientDto, GetClientOrdersUseCase $getClientOrdersUseCase): Response
    {
        return successJSONResponse($getClientOrdersUseCase->execute($clientDto));
    }

    #[Post('/search')]
    public function searchClientColumn(SearchClientDto $searchClientDto, SearchClientUseCase $searchClientUseCase): Response
    {
        return successJSONResponse($searchClientUseCase->execute($searchClientDto));
    }
}