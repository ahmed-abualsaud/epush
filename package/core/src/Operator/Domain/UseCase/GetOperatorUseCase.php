<?php

namespace Epush\Core\Operator\Domain\UseCase;

use Epush\Core\Operator\Domain\DTO\OperatorDto;
use Epush\Core\Operator\App\Contract\OperatorServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetOperatorUseCase
{
    public function __construct(

        private OperatorServiceContract $operatorService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(OperatorDto $operatorDto): array
    {
        $this->validationService->validate($operatorDto->toArray(), OperatorDto::rules());
        return $this->operatorService->get($operatorDto->getOperatorID());
    }
}