<?php

namespace Epush\Auth\User\Domain\UseCase;

use Epush\Auth\User\Domain\DTO\SearchUserDto;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchUserUseCase
{
    public function __construct(

        private UserServiceContract $userService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchUserDto $searchUserDto): array
    {
        $this->validationService->validate($searchUserDto->toArray(), SearchUserDto::rules());
        return $this->userService->searchColumn($searchUserDto->getSearchColumn(), $searchUserDto->getSearchValue(), $searchUserDto->getPageSize());
    }
}