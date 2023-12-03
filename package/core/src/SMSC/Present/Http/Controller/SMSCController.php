<?php

namespace Epush\Core\SMSC\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\SMSC\Domain\DTO\SMSCDto;
use Epush\Core\SMSC\Domain\DTO\AddSMSCDto;
use Epush\Core\SMSC\Domain\DTO\ListSMSCsDto;
use Epush\Core\SMSC\Domain\DTO\SearchSMSCDto;
use Epush\Core\SMSC\Domain\DTO\UpdateSMSCDto;

use Epush\Core\SMSC\Domain\UseCase\GetSMSCUseCase;
use Epush\Core\SMSC\Domain\UseCase\AddSMSCUseCase;
use Epush\Core\SMSC\Domain\UseCase\ListSMSCsUseCase;
use Epush\Core\SMSC\Domain\UseCase\DeleteSMSCUseCase;
use Epush\Core\SMSC\Domain\UseCase\SearchSMSCUseCase;
use Epush\Core\SMSC\Domain\UseCase\UpdateSMSCUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/smsc')]
class SMSCController
{
    #[Get('/')]
    public function listSMSCs(ListSMSCsDto $listSMSCsDto, ListSMSCsUseCase $listSMSCsUseCase): Response
    {
        return jsonResponse($listSMSCsUseCase->execute($listSMSCsDto));
    }

    #[Post('/')]
    public function addSMSC(AddSMSCDto $addSMSCDto, AddSMSCUseCase $addSMSCUseCase): Response
    {
        return jsonResponse($addSMSCUseCase->execute($addSMSCDto));
    }

    #[Get('{smsc_id}')]
    public function getSMSC(SMSCDto $smscDto, GetSMSCUseCase $getSMSCUseCase): Response
    {
        return jsonResponse($getSMSCUseCase->execute($smscDto));
    }

    #[Put('{smsc_id}')]
    public function updateSMSC(SMSCDto $smscDto, UpdateSMSCDto $updateSMSCDto, UpdateSMSCUseCase $updateSMSCUseCase): Response
    {
        return jsonResponse($updateSMSCUseCase->execute($smscDto, $updateSMSCDto));
    }

    #[Delete('{smsc_id}')]
    public function deleteSMSC(SMSCDto $smscDto, DeleteSMSCUseCase $deleteSMSCUseCase): Response
    {
        return jsonResponse($deleteSMSCUseCase->execute($smscDto));
    }

    #[Post('/search')]
    public function searchSMSCColumn(SearchSMSCDto $searchSMSCDto, SearchSMSCUseCase $searchSMSCUseCase): Response
    {
        return jsonResponse($searchSMSCUseCase->execute($searchSMSCDto));
    }
}