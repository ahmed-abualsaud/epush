<?php

namespace Epush\Core\Operator\Domain\UseCase;

use Epush\Core\Operator\Domain\DTO\ListOperatorsDto;
use Epush\Core\Operator\App\Contract\OperatorServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListOperatorsUseCase
{
    public function __construct(

        private OperatorServiceContract $operatorService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListOperatorsDto $listOperatorsDto): array
    {
        $this->validationService->validate($listOperatorsDto->toArray(), ListOperatorsDto::rules());
        return $this->operatorService->list($listOperatorsDto->getPageSize());
    }
}