<?php

namespace Epush\Auth\Domain\UseCase;

use Epush\Auth\Domain\DTO\ListUsersDto;
use Epush\Auth\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListUsersUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListUsersDto $listUsersDto): array
    {
        $this->validationService->validate($listUsersDto->toArray(), ListUsersDto::rules());
        return $this->userService->list($listUsersDto->getPageSize());
    }
}