<?php

namespace Epush\Core\SMSCBinding\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\SMSCBinding\Domain\DTO\SMSCBindingDto;
use Epush\Core\SMSCBinding\Domain\DTO\AddSMSCBindingDto;
use Epush\Core\SMSCBinding\Domain\DTO\ListSMSCBindingsDto;
use Epush\Core\SMSCBinding\Domain\DTO\SearchSMSCBindingDto;
use Epush\Core\SMSCBinding\Domain\DTO\UpdateSMSCBindingDto;

use Epush\Core\SMSCBinding\Domain\UseCase\GetSMSCBindingUseCase;
use Epush\Core\SMSCBinding\Domain\UseCase\AddSMSCBindingUseCase;
use Epush\Core\SMSCBinding\Domain\UseCase\ListSMSCBindingsUseCase;
use Epush\Core\SMSCBinding\Domain\UseCase\DeleteSMSCBindingUseCase;
use Epush\Core\SMSCBinding\Domain\UseCase\SearchSMSCBindingUseCase;
use Epush\Core\SMSCBinding\Domain\UseCase\UpdateSMSCBindingUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/smsc-binding')]
class SMSCBindingController
{
    #[Get('/')]
    public function listSMSCBindings(ListSMSCBindingsDto $listSMSCBindingsDto, ListSMSCBindingsUseCase $listSMSCBindingsUseCase): Response
    {
        return jsonResponse($listSMSCBindingsUseCase->execute($listSMSCBindingsDto));
    }

    #[Post('/')]
    public function addSMSCBinding(AddSMSCBindingDto $addSMSCBindingDto, AddSMSCBindingUseCase $addSMSCBindingUseCase): Response
    {
        return jsonResponse($addSMSCBindingUseCase->execute($addSMSCBindingDto));
    }

    #[Get('{smsc_binding_id}')]
    public function getSMSCBinding(SMSCBindingDto $smscbindingDto, GetSMSCBindingUseCase $getSMSCBindingUseCase): Response
    {
        return jsonResponse($getSMSCBindingUseCase->execute($smscbindingDto));
    }

    #[Put('{smsc_binding_id}')]
    public function updateSMSCBinding(SMSCBindingDto $smscbindingDto, UpdateSMSCBindingDto $updateSMSCBindingDto, UpdateSMSCBindingUseCase $updateSMSCBindingUseCase): Response
    {
        return jsonResponse($updateSMSCBindingUseCase->execute($smscbindingDto, $updateSMSCBindingDto));
    }

    #[Delete('{smsc_binding_id}')]
    public function deleteSMSCBinding(SMSCBindingDto $smscbindingDto, DeleteSMSCBindingUseCase $deleteSMSCBindingUseCase): Response
    {
        return jsonResponse($deleteSMSCBindingUseCase->execute($smscbindingDto));
    }

    #[Post('/search')]
    public function searchSMSCBindingColumn(SearchSMSCBindingDto $searchSMSCBindingDto, SearchSMSCBindingUseCase $searchSMSCBindingUseCase): Response
    {
        return jsonResponse($searchSMSCBindingUseCase->execute($searchSMSCBindingDto));
    }
}