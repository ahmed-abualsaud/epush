<?php

namespace Epush\Core\BusinessField\Domain\UseCase;

use Epush\Core\BusinessField\Domain\DTO\AddBusinessFieldDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Core\BusinessField\App\Contract\BusinessFieldServiceContract;

class AddBusinessFieldUseCase
{
    public function __construct(

        private BusinessFieldServiceContract $businessFieldService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddBusinessFieldDto $addBusinessFieldDto): array
    {
        $this->validationService->validate($addBusinessFieldDto->toArray(), AddBusinessFieldDto::rules());
        return $this->businessFieldService->add($addBusinessFieldDto->toArray());
    }
}