<?php

namespace Epush\Core\Operator\Domain\UseCase;

use Epush\Core\Operator\Domain\DTO\OperatorDto;
use Epush\Core\Operator\Domain\DTO\UpdateOperatorDto;
use Epush\Core\Operator\App\Contract\OperatorServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateOperatorUseCase
{
    public function __construct(

        private OperatorServiceContract $operatorService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(OperatorDto $operatorDto, UpdateOperatorDto $updateOperatorDto): array
    {
        $this->validationService->validate($operatorDto->toArray(), OperatorDto::rules());
        $this->validationService->validate($updateOperatorDto->toArray(), UpdateOperatorDto::rules());
        return $this->operatorService->update($operatorDto->getOperatorID(), $updateOperatorDto->toArray());
    }
}