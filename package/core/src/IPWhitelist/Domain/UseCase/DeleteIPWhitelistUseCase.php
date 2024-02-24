<?php

namespace Epush\Core\IPWhitelist\Domain\UseCase;

use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;
use Epush\Core\IPWhitelist\Domain\DTO\IPWhitelistDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteIPWhitelistUseCase
{
    public function __construct(

        private IPWhitelistServiceContract $ipwhitelistService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(IPWhitelistDto $ipwhitelistDto): bool
    {
        $this->validationService->validate($ipwhitelistDto->toArray(), IPWhitelistDto::rules());
        return $this->ipwhitelistService->delete($ipwhitelistDto->getIPWhitelistID());
    }
}