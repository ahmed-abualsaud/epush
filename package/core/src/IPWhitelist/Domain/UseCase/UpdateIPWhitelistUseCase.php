<?php

namespace Epush\Core\IPWhitelist\Domain\UseCase;

use Epush\Core\IPWhitelist\Domain\DTO\IPWhitelistDto;
use Epush\Core\IPWhitelist\Domain\DTO\UpdateIPWhitelistDto;
use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateIPWhitelistUseCase
{
    public function __construct(

        private IPWhitelistServiceContract $ipwhitelistService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(IPWhitelistDto $ipwhitelistDto, UpdateIPWhitelistDto $updateIPWhitelistDto): array
    {
        $this->validationService->validate($ipwhitelistDto->toArray(), IPWhitelistDto::rules());
        $this->validationService->validate($updateIPWhitelistDto->toArray(), UpdateIPWhitelistDto::rules());
        return $this->ipwhitelistService->update($ipwhitelistDto->getIPWhitelistID(), $updateIPWhitelistDto->toArray());
    }
}