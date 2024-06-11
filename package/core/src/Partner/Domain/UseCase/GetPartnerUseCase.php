<?php

namespace Epush\Core\Partner\Domain\UseCase;

use Epush\Core\Partner\Domain\DTO\PartnerDto;
use Epush\Core\Partner\App\Contract\PartnerServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetPartnerUseCase
{
    public function __construct(

        private PartnerServiceContract $partnerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(PartnerDto $partnerDto): array
    {
        $this->validationService->validate($partnerDto->toArray(), PartnerDto::rules());
        return $this->partnerService->get($partnerDto->getUserID());
    }
}