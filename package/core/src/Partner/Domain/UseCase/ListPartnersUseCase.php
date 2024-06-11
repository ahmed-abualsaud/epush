<?php

namespace Epush\Core\Partner\Domain\UseCase;

use Epush\Core\Partner\Domain\DTO\ListPartnersDto;
use Epush\Core\Partner\App\Contract\PartnerServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListPartnersUseCase
{
    public function __construct(

        private PartnerServiceContract $partnerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListPartnersDto $listPartnersDto): array
    {
        $this->validationService->validate($listPartnersDto->toArray(), ListPartnersDto::rules());
        return $this->partnerService->list($listPartnersDto->getPageSize());
    }
}