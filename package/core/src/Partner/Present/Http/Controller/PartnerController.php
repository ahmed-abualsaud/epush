<?php

namespace Epush\Core\Partner\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\Partner\Domain\DTO\PartnerDto;
use Epush\Core\Partner\Domain\DTO\AddPartnerDto;
use Epush\Core\Partner\Domain\DTO\ListPartnersDto;
use Epush\Core\Partner\Domain\DTO\SearchPartnerDto;
use Epush\Core\Partner\Domain\DTO\UpdatePartnerDto;

use Epush\Core\Partner\Domain\UseCase\GetPartnerUseCase;
use Epush\Core\Partner\Domain\UseCase\AddPartnerUseCase;
use Epush\Core\Partner\Domain\UseCase\ListPartnersUseCase;
use Epush\Core\Partner\Domain\UseCase\DeletePartnerUseCase;
use Epush\Core\Partner\Domain\UseCase\SearchPartnerUseCase;
use Epush\Core\Partner\Domain\UseCase\UpdatePartnerUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/partner')]
class PartnerController
{
    #[Get('/')]
    public function listPartners(ListPartnersDto $listPartnersDto, ListPartnersUseCase $listPartnersUseCase): Response
    {
        return jsonResponse($listPartnersUseCase->execute($listPartnersDto));
    }

    #[Post('/')]
    public function addPartner(AddPartnerDto $addPartnerDto, AddPartnerUseCase $addPartnerUseCase): Response
    {
        return jsonResponse($addPartnerUseCase->execute($addPartnerDto));
    }

    #[Get('{user_id}')]
    public function getPartner(PartnerDto $partnerDto, GetPartnerUseCase $getPartnerUseCase): Response
    {
        return jsonResponse($getPartnerUseCase->execute($partnerDto));
    }

    #[Put('{user_id}')]
    public function updatePartner(PartnerDto $partnerDto, UpdatePartnerDto $updatePartnerDto, UpdatePartnerUseCase $updatePartnerUseCase): Response
    {
        return jsonResponse($updatePartnerUseCase->execute($partnerDto, $updatePartnerDto));
    }

    #[Delete('{user_id}')]
    public function deletePartner(PartnerDto $partnerDto, DeletePartnerUseCase $deletePartnerUseCase): Response
    {
        return jsonResponse($deletePartnerUseCase->execute($partnerDto));
    }

    #[Post('/search')]
    public function searchPartnerColumn(SearchPartnerDto $searchPartnerDto, SearchPartnerUseCase $searchPartnerUseCase): Response
    {
        return jsonResponse($searchPartnerUseCase->execute($searchPartnerDto));
    }
}