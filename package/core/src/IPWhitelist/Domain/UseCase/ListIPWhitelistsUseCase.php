<?php

namespace Epush\Core\IPWhitelist\Domain\UseCase;

use Epush\Core\IPWhitelist\Domain\DTO\ListIPWhitelistsDto;
use Epush\Core\IPWhitelist\App\Contract\IPWhitelistServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListIPWhitelistsUseCase
{
    public function __construct(

        private IPWhitelistServiceContract $ipwhitelistService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListIPWhitelistsDto $listIPWhitelistsDto): array
    {
        $this->validationService->validate($listIPWhitelistsDto->toArray(), ListIPWhitelistsDto::rules());
        return $this->ipwhitelistService->list($listIPWhitelistsDto->getPageSize());
    }
}