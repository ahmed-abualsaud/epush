<?php

namespace Epush\Core\IPWhitelist\Domain\UseCase;

use Epush\Core\IPWhitelist\Domain\DTO\IPWhitelistDto;
use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetIPWhitelistUseCase
{
    public function __construct(

        private IPWhitelistServiceContract $ipwhitelistService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(IPWhitelistDto $ipwhitelistDto): array
    {
        $this->validationService->validate($ipwhitelistDto->toArray(), IPWhitelistDto::rules());
        return $this->ipwhitelistService->get($ipwhitelistDto->getIPWhitelistID());
    }
}