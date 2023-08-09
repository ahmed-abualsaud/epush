<?php

namespace Epush\Core\BusinessField\Domain\UseCase;

use Epush\Core\BusinessField\App\Contract\BusinessFieldServiceContract;

class ListBusinessFieldsUseCase
{
    public function __construct(

        private BusinessFieldServiceContract $businessFieldService

    ) {}

    public function execute(): array
    {
        return $this->businessFieldService->list();
    }
}