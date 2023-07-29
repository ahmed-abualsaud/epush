<?php

namespace Epush\Core\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Core\Domain\DTO\ClientDto;
use Epush\Core\Domain\UseCase\GetClientUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/client')]
class ClientController
{
    #[Get('{client_id}')]
    public function getClient(ClientDto $clientDto, GetClientUseCase $getClientUseCase): Response
    {
        return successJSONResponse($getClientUseCase->execute($clientDto));
    }
}