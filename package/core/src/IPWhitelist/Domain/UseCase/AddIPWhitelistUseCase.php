<?php

namespace Epush\Core\IPWhitelist\Domain\UseCase;

use Epush\Core\IPWhitelist\Domain\DTO\AddIPWhitelistDto;
use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddIPWhitelistUseCase
{
    public function __construct(

        private IPWhitelistServiceContract $ipwhitelistService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddIPWhitelistDto $addIPWhitelistDto): array
    {
        $this->validationService->validate($addIPWhitelistDto->toArray(), AddIPWhitelistDto::rules());
        return $this->ipwhitelistService->add($addIPWhitelistDto->toArray());
    }
}