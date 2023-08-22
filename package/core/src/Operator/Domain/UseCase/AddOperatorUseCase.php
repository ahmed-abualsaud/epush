<?php

namespace Epush\Core\Operator\Domain\UseCase;

use Epush\Core\Operator\Domain\DTO\AddOperatorDto;
use Epush\Core\Operator\App\Contract\OperatorServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class AddOperatorUseCase
{
    public function __construct(

        private OperatorServiceContract $operatorService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddOperatorDto $addOperatorDto): array
    {
        $this->validationService->validate($addOperatorDto->toArray(), AddOperatorDto::rules());
        return $this->operatorService->add($addOperatorDto->toArray());
    }
}