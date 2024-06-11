<?php

namespace Epush\Core\Partner\Domain\UseCase;

use Epush\Core\Partner\Domain\DTO\PartnerDto;
use Epush\Core\Partner\Domain\DTO\UpdatePartnerDto;
use Epush\Core\Partner\App\Contract\PartnerServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdatePartnerUseCase
{
    public function __construct(

        private PartnerServiceContract $partnerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(PartnerDto $partnerDto, UpdatePartnerDto $updatePartnerDto): array
    {
        $this->validationService->validate($partnerDto->toArray(), PartnerDto::rules());
        $this->validationService->validate($updatePartnerDto->toArray(), UpdatePartnerDto::rules());
        return $this->partnerService->update($partnerDto->getUserID(), $updatePartnerDto->getPartner(), $updatePartnerDto->getUser());
    }
}