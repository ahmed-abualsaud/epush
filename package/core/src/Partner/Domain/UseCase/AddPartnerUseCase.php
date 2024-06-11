<?php

namespace Epush\Core\Partner\Domain\UseCase;

use Epush\Core\Partner\Domain\DTO\AddPartnerDto;
use Epush\Core\Partner\App\Contract\PartnerServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddPartnerUseCase
{
    public function __construct(

        private PartnerServiceContract $partnerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddPartnerDto $addPartnerDto): array
    {
        $this->validationService->validate($addPartnerDto->toArray(), AddPartnerDto::rules());
        return $this->partnerService->add($addPartnerDto->getPartner(), $addPartnerDto->getUser());
    }
}