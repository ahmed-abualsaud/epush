<?php

namespace Epush\Core\Operator\Domain\UseCase;

use Epush\Core\Operator\App\Contract\OperatorServiceContract;
use Epush\Core\Operator\Domain\DTO\OperatorDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteOperatorUseCase
{
    public function __construct(

        private OperatorServiceContract $operatorService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(OperatorDto $operatorDto): bool
    {
        $this->validationService->validate($operatorDto->toArray(), OperatorDto::rules());
        return $this->operatorService->delete($operatorDto->getOperatorID());
    }
}